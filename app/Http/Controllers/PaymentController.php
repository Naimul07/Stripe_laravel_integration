<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $stripeSecret = env('STRIPE_SECRET');
        $stripe = new \Stripe\StripeClient($stripeSecret);

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Sample Product',
                    ],
                    'unit_amount' => 2000, // Amount in cents ($20.00)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);

        // Redirect the user to Stripe's checkout URL
        return redirect($checkout_session->url);
    }

    public function pay()
    {
        // return response()->json('hi');
        $stripeSecret = env('STRIPE_SECRET');

        $stripe = new \Stripe\StripeClient($stripeSecret);
       

        $YOUR_DOMAIN = 'http://localhost:5713';

        $checkout_session = $stripe->checkout->sessions->create([
            'ui_mode' => 'embedded',
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Sample Product',
                    ],
                    'unit_amount' => 2000, // Amount in cents ($20.00)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'return_url' => $YOUR_DOMAIN . '/return?session_id={CHECKOUT_SESSION_ID}',
        ]);

        return response()->json([
            'clientSecret' => $checkout_session->client_secret, // Provide the session ID to the frontend
        ]);
    }

    public function success(Request $request)
    {
        return "Payment successful! Session ID: " . $request->get('session_id');
    }

    public function cancel()
    {
        return "Payment was canceled.";
    }
}
