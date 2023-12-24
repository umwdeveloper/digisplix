<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class PaymentController extends Controller {
    public function createCheckoutSession(Request $request) {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            "currency" => 'usd',
                            "product_data" => ["name" => "Item 1"],
                            "unit_amount" => intval($request->amount) * 100
                        ],
                        'quantity' => 1
                    ]
                ],
                'mode' => 'payment',
                'currency' => 'usd',
                // 'payment_method_types' => ['card', 'alipay'],
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ]);

            return response()->json([
                'session' => $session
            ]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function success() {
        //
    }

    public function cancel() {
        //
    }
}
