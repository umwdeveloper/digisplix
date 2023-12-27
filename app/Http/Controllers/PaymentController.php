<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\SignatureVerificationException;
use Stripe\PaymentIntent;
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
                    'quantity' => 1
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

    public function createPaymentIntent(Request $request) {
        Stripe::setApiKey(config('custom.stripe_secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 1000, // Amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'confirm' => true, // Confirm immediately
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
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

        try {
            $session = Session::create($data);
            return response()->json(['session' => $session]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
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
                    $invoice = Invoice::findOrFail($invoiceId);
                    $invoice->status = Invoice::PAID;
                    $invoice->save();
                }
                break;
        }

        return response()->json(['success' => true]);
    }
}
