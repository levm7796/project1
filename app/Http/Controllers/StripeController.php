<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Laravel\Cashier\Cashier;

class StripeController extends Controller
{
    public function checkout(Request $request) {
        Stripe::setApiKey('sk_test_51PGMNPAcSiYCPjwc6yACQNerANoeWdO274Dewom3yNy7Yt6yGRzsUO3ac7DSAWEo4N3va2mZdpzagXgNDDOzSw1X00Vhv7jjy0');
        $session = Session::create([
            'line_items' => [
                [
                        'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Total price'
                    ],
                    'unit_amount' => $request->input('price') * 100
                    ],
                    'quantity' => 1,
                ],
                ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:5173/success',
            'cancel_url' => 'http://localhost:5173/'
        ]);

        return $session->url;
    }

    public function createOrder(Request $request) {
            if($request->input('items') !== null) {
                $items = $request->input('items');
                $id = [];
                for($i = 0; $i<count($items); $i++) {
                    if($items[$i]['pics'] !== 1) {
                        for ($x = 0; $x < $items[$i]['pics']; $x++) {
                            Order::create([
                                'productId' => $items[$i]['id'],
                                'email' => $request->input('email'),
                                'price' => $items[$i]['price'],
                                'status' => false
                            ]);
                            array_push($id, DB::table('orders')->select('id')->orderBy('id', 'desc')->first());
                        }
                    }
                    else {
                    Order::create([
                        'productId' => $items[$i]['id'],
                        'email' => $request->input('email'),
                        'price' => $items[$i]['price'],
                        'status' => false
                    ]);
                    array_push($id, DB::table('orders')->select('id')->orderBy('created_at', 'desc')->first());
                    }
                }

                return array($id);
            } else {
                Order::create([
                    'productId' => $request->input('productId'),
                    'email' => $request->input('email'),
                    'price' => $request->input('price'),
                    'status' => false
                ]);
                $id = DB::table('orders')->select('id')->orderBy('created_at', 'desc')->first();
                return $id;
            }
    }

    public function updateOrder(Request $request) {
        $id = $request->input('id');
        $id = $id[0];
        for($i = 0; $i<count($id); $i++) {
        DB::table('orders')->where('id', $id[$i])->update(array('status' => true));
        }
        return $id;
//        return $id;
    }
}
