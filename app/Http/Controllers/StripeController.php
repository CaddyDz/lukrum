<?php

namespace App\Http\Controllers;

use App\utils\Pmc\PmcForm;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function CreatePayment(Request $request) {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET', 'sk_test_51IQKMfBI0Y0RNZhbocmy00DuwKW4jsxZJltnjr7jbK0jdiBziHT0l20gtxktR1fuAkjEQ3Uumv3LXfX5s0sZ8bVE00KcKZDhJM'));

        $pmc = PmcForm::FromShortHash($request->hash);
        $json = $pmc->Payment()->toJson();

        try {
            // retrieve JSON from POST body
            $paymentIntent = \Stripe\PaymentIntent::create([
                'description' => $json->productName,
                'amount' => round(100 * $json->productPrice),
                'currency' => 'usd',
                'receipt_email' => $pmc->GetModel()->email,
            ]);

            return response()->json($output = [
                'clientSecret' => $paymentIntent->client_secret,
            ]);

        } catch (\Error $e) {
            http_response_code(500);
            return response()->json(['error' => $e->getMessage()]);
        }
    }

/*
//Stripe test key: pk_test_51IQKMfBI0Y0RNZhboumnKSHDttcOzEbR1ovgVyiAWbiO1hNNeie0Z7gqMap6zP1BMUnfBGl7maXY9ZcrRUR85x5q00BFQhpfPS
//Stripe test secret: sk_test_51IQKMfBI0Y0RNZhbocmy00DuwKW4jsxZJltnjr7jbK0jdiBziHT0l20gtxktR1fuAkjEQ3Uumv3LXfX5s0sZ8bVE00KcKZDhJM



paymentIntent:
    amount: 3000
    canceled_at: null
    cancellation_reason: null
    capture_method: "automatic"
    client_secret: "pi_1ISedXBI0Y0RNZhbzdM9WYpc_secret_DSXq6Nj6srk2cGTce64M3P5bc"
    confirmation_method: "automatic"
    created: 1615192823
    currency: "usd"
    description: null
    id: "pi_1ISedXBI0Y0RNZhbzdM9WYpc"
    last_payment_error: null
    livemode: false
    next_action: null
    object: "payment_intent"
    payment_method: "pm_1ISee9BI0Y0RNZhbqcTBYQiA"
    payment_method_types: ["card"]
    receipt_email: null
    setup_future_usage: null
    shipping: null
    source: null
    status: "succeeded"
     */
}
