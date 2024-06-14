<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Checkout\Session;
class PaymentController extends Controller
{
    public function checkout(Request $req){


        Stripe::setApiKey(config('stripe.sk'));

        $productname = $req->get('hotelname');
        $userid = $req->get('userid');

        $totalprice =$req->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'USD',
                        'product_data' => [
                            "name" => $productname,

                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('success',$userid),
            'cancel_url'  => route('payment'),
        ]);

        return redirect()->away($session->url);





    }


    public function success($id){

       $rese= Reservation::where('user_id',$id)->update(['status'=>1]);

       if($rese){

      return redirect()->route('My_Cart')->with(['success'=>'Reservation Confirmed Successfully']);


       }else{
        return redirect()->route('My_Cart')->with(['error'=>'Please make sure you have balance in your cart']);
       }

    }
}