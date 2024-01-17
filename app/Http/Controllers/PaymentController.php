<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\User;
use App\Notifications\InvoicePaid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\PaymentIntent;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Webhook;

class PaymentController extends Controller {
    public function createCheckoutSession(Request $request) {

        $invoice = Invoice::findOrFail($request->invoice_id);

        $client = Client::findOrFail(auth()->user()->userable_id);

        Stripe::setApiKey(config('custom.stripe_secret'));

        $customer_id = null;
        if (!empty($client->customer_id)) {
            $customer_id = $client->customer_id;
        } else {
            $customer = Customer::create([
                'name' => $client->user->name,
                'email' => $client->user->email,
            ]);

            if (!empty($customer)) {
                $customer_id = $customer->id;

                $client->customer_id = $customer_id;
                $client->save();
            }
        }

        $data = [];
        $data['ui_mode'] = 'embedded';
        $data['currency'] = 'usd';
        $data['return_url'] = route('payment.success');
        $data['metadata'] = [
            'invoice_id' => $request->invoice_id,
            'invoice_number' => $request->invoice_number
        ];

        $data['consent_collection'] = ['terms_of_service' => 'required'];
        $data['custom_text'] = [
            'terms_of_service_acceptance' => [
                'message' => 'I agree to the [Terms of Service](https://digisplix.com/terms) and [Privacy Policy](https://digisplix.com/privacy)',
            ],
        ];

        if ($invoice->recurring) {
            $start_from = Carbon::parse($invoice->start_from)->startOfDay();
            $cancel_at = $start_from->addMonths($invoice->duration)->endOfDay();

            $data['mode'] = 'subscription';
            $data['line_items'] = [
                [
                    'price_data' => [
                        "currency" => 'usd',
                        "product_data" => ["name" => "Invoice# " . $request->invoice_number],
                        "unit_amount" => floatval($request->amount) * 100,
                        'recurring' => [
                            'interval' => 'month'
                        ]
                    ],
                    'quantity' => 1,
                ]
            ];
        } else {
            $data['mode'] = 'payment';
            $data['line_items'] = [
                [
                    'price_data' => [
                        "currency" => 'usd',
                        "product_data" => ["name" => "Invoice# " . $request->invoice_number],
                        "unit_amount" => floatval($request->amount) * 100
                    ],
                    'quantity' => 1
                ]
            ];
        }

        try {
            $session = Session::create($data);

            return response()->json(['session' => $session]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function subscribe(Request $request) {

        $client = Client::findOrFail(auth()->user()->userable_id);

        Stripe::setApiKey(config('custom.stripe_secret'));

        $customer_id = null;
        if (!empty($client->customer_id)) {
            $customer_id = $client->customer_id;
        } else {
            $customer = Customer::create([
                'name' => $client->user->name,
                'email' => $client->user->email,
            ]);

            if (!empty($customer)) {
                $customer_id = $customer->id;

                $client->customer_id = $customer_id;
                $client->save();
            }
        }

        $plansDb = Plan::all();

        foreach ($plansDb as $plan) {
            $plans[$plan->name] = $plan->price_id;
        }

        $plans = [
            'silver' => 'price_1ORSXPHymsUfbx7xSvZRkySS',
            'gold' => 'price_1ORSXeHymsUfbx7xbjJupdB7',
            'platinum' => 'price_1ORSXsHymsUfbx7xZI00QCVp',
            'diamond' => 'price_1ORSY4HymsUfbx7xlZQO4cNQ'
        ];

        $data = [];
        $data['ui_mode'] = 'embedded';
        $data['currency'] = 'usd';
        $data['return_url'] = route('payment.success');

        $data['mode'] = 'subscription';
        $data['line_items'] = [
            [
                'price' => $plans[$request->plan],
                'quantity' => 1
            ]
        ];

        $data['consent_collection'] = ['terms_of_service' => 'required'];
        $data['custom_text'] = [
            'terms_of_service_acceptance' => [
                'message' => 'I agree to the [Terms of Service](https://digisplix.com/terms) and [Privacy Policy](https://digisplix.com/privacy)',
            ],
        ];

        try {
            $session = Session::create($data);
            return response()->json(['session' => $session]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public static function createPaymentIntent(Request $request) {
        Stripe::setApiKey(config('custom.stripe_secret'));

        $client = Client::findOrFail($request->client_id);
        $amount = $request->amount;

        $customer_id = null;
        if (!empty($client->customer_id)) {
            $customer_id = $client->customer_id;
        } else {
            $customer = Customer::create([
                'name' => $client->user->name,
                'email' => $client->user->email,
            ]);

            if (!empty($customer)) {
                $customer_id = $customer->id;

                $client->customer_id = $customer_id;
                $client->save();
            }
        }

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'customer' => $customer_id,
                'payment_method_types' => ['customer_balance'],
                'payment_method_data' => ['type' => 'customer_balance'],
                'payment_method_options' => [
                    'customer_balance' => [
                        'funding_type' => 'bank_transfer',
                        'bank_transfer' => ['type' => 'us_bank_transfer'],
                    ],
                ],
                'confirm' => true,
                'metadata' => [
                    'invoice_id' => $request->invoice_id
                ]
            ]);

            if ($paymentIntent->status == 'succeeded') {
                $invoice = Invoice::with('client')->findOrFail($request->invoice_id);

                $invoice->status = Invoice::PAID;
                $invoice->save();

                $invoice->client->active = 1;
                $invoice->client->save();
            }

            if ($paymentIntent->status !== 'requires_action' && $paymentIntent->status !== 'succeeded') {
                return response()->json([
                    'error' => "Sorry! Bank transfer is not supported for your country.",
                    'details' => $paymentIntent
                ]);
            } else {
                return response()->json([
                    'paymentDetails' => $paymentIntent,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public static function createSubscription(Request $request) {
        Stripe::setApiKey(config('custom.stripe_secret'));

        $client = Client::findOrFail($request->client_id);
        $amount = $request->amount;

        $customer_id = null;
        if (!empty($client->customer_id)) {
            $customer_id = $client->customer_id;
        } else {
            $customer = Customer::create([
                'name' => $client->user->name,
                'email' => $client->user->email,
            ]);

            if ($customer && !empty($customer)) {
                $customer_id = $customer->id;

                $client->customer_id = $customer_id;
                $client->save();
            }
        }

        $price_id = null;
        // Create stripe price
        $price = Price::create([
            'currency' => 'usd',
            'unit_amount' => floatval($amount) * 100,
            'recurring' => ['interval' => 'month'],
            'product_data' => ['name' => 'Invoice# ' . $request->invoice_number],
        ]);

        if ($price && !empty($price)) {
            $price_id = $price->id;
        }

        $due_date = Carbon::parse($request->due_date);
        $days_until_due = now()->diffInDays($due_date);

        if (!empty($customer_id) && !empty($price_id)) {
            try {
                $subscription = Subscription::create([
                    'customer' => $customer_id,
                    'items' => [[
                        'price' => $price_id,
                    ]],
                    'collection_method' => 'send_invoice',
                    'days_until_due' => $days_until_due,
                    'payment_settings' => [
                        'payment_method_types' => ['customer_balance'],
                    ],
                    'metadata' => [
                        'invoice_id' => $request->invoice_id
                    ],
                ]);

                if ($subscription->status == 'succeeded') {
                    $invoice = Invoice::with('client')->findOrFail($request->invoice_id);

                    $invoice->status = Invoice::PAID;
                    $invoice->save();

                    $invoice->client->active = 1;
                    $invoice->client->save();
                }

                if ($subscription->status == 'active') {
                    $invoice = Invoice::findOrFail($request->invoice_id);

                    $invoice->bank_subscription_active = 1;
                    $invoice->save();
                }

                if ($subscription->status !== 'requires_action' && $subscription->status !== 'succeeded' && $subscription->status !== 'active') {
                    return response()->json([
                        'error' => "Sorry! Bank transfer is not supported for your country.",
                        'details' => $subscription
                    ]);
                } else {
                    return response()->json([
                        'paymentDetails' => $subscription,
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                ], 500);
            }
        } else {
            return response()->json([
                'generalError' => "Sorry! Something went wrong please try again later.",
            ]);
        }
    }

    public function success() {
        return view('clients.invoices.success');
    }

    public function cancel() {
        //
    }

    // Webhooks
    public function webhookPayment(Request $request) {
        $endpoint_secret = config('custom.stripe_webhook_payment');
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        Stripe::setApiKey(config('custom.stripe_secret'));

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            Log::info('Stripe Webhook Failed Data:', ['error' => $e]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $metadata = $session->metadata;

                if ($session->payment_status == "paid") {
                    $invoiceId = $metadata->invoice_id;
                    $invoice = Invoice::with('client')
                        ->withSum('items', 'price')
                        ->findOrFail($invoiceId);
                    $invoice->status = Invoice::PAID;
                    $invoice->save();

                    $invoice->client->active = 1;
                    $invoice->client->save();

                    Notification::send($invoice->client->user, new InvoicePaid($invoice, $invoice->items_sum_price));
                    Notification::send(User::getAdmin(), new InvoicePaid($invoice, $invoice->items_sum_price));
                }
                break;
            case 'payment_intent.succeeded':
                $payment = $event->data->object;
                $metadata = $payment->metadata;

                if (!empty($metadata) && $payment->status == "succeeded") {
                    $invoiceId = $metadata->invoice_id;
                    $invoice = Invoice::with('client')
                        ->withSum('items', 'price')
                        ->findOrFail($invoiceId);
                    $invoice->status = Invoice::PAID;
                    $invoice->save();

                    $invoice->client->active = 1;
                    $invoice->client->save();

                    Notification::send($invoice->client->user, new InvoicePaid($invoice, $invoice->items_sum_price));
                    Notification::send(User::getAdmin(), new InvoicePaid($invoice, $invoice->items_sum_price));
                }
                break;
            case 'invoice.paid':
                $payment = $event->data->object;
                if ($payment->subscription_details && !empty($payment->subscription_details)) {
                    $metadata = $payment->subscription_details->metadata;

                    if (!empty($metadata)) {
                        $invoiceId = $metadata->invoice_id;
                        $invoice = Invoice::with('client')
                            ->withSum('items', 'price')
                            ->findOrFail($invoiceId);
                        $invoice->status = Invoice::PAID;
                        $invoice->save();

                        $invoice->client->active = 1;
                        $invoice->client->save();

                        Notification::send($invoice->client->user, new InvoicePaid($invoice, $invoice->items_sum_price));
                        Notification::send(User::getAdmin(), new InvoicePaid($invoice, $invoice->items_sum_price));
                    }
                }
                break;
        }

        return response()->json(['success' => true]);
    }
}
