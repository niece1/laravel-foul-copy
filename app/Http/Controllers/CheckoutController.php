<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }
        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

      # dd($this->getValues());
        return view('checkout', array(
           'discount' =>$this->getValues()->get('discount'),
           'newSubtotal' =>$this->getValues()->get('newSubtotal'),
           'newTax' =>$this->getValues()->get('newTax'),
           'newTotal' =>$this->getValues()->get('newTotal'),
        ));

    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
    // dd($request->all());

        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug.', '.$item->qty;
        })->values()->toJson();
      
        try {
            $charge = Stripe::charges()->create([
              //  'amount' => Cart::total(),
                'amount' => $this->getValues()->get('newTotal'),
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Order',
              #  'receipt_email' => $request->email,
                'metadata' => [
                    //change to Order id if start using DB
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (CardErrorException $e) {
           # $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    private function getValues()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal()-$discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax);

        return collect([
          'tax'=>$tax,
          'discount'=>$discount,
          'newSubtotal'=>$newSubtotal,
          'newTax'=>$newTax,
          'newTotal'=>$newTotal,
        ]);
    }
    
}
