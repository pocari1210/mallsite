<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
  public function StripeOrder(Request $request)
  {

    \Stripe\Stripe::setApiKey('sk_test_51KdKmKIqU18BrtXMvtRilySQHfRBnlwHKMRbep955ovxk8dR6ThlevT2tlN3JcuJzqprYuX6HHytWXCXUMXtM9OG00nHpWVOJJ');

    $token = $_POST['stripeToken'];

    $charge = \Stripe\Charge::create([
      'amount' => 999 * 100,
      'currency' => 'usd',
      'description' => 'Test Shop',
      'source' => $token,
      'metadata' => ['order_id' => '6735'],
    ]);

    dd($charge);
  } // End Method 
}
