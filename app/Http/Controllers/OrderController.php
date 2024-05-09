<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function cart() {
        return view('e-commerce.cart');
    }

    public function checkout() {
        return view('e-commerce.checkout');
    }

    public function confirmOrder(OrderRequest $request) {
        $orderLines = json_decode($request->cart_info);

        $lines = [];
        $totalPrice = 0;

        foreach($orderLines as $line) {
            $lines[] = [
                'campaign_id' => $line->campaignId,
                'product_id' => $line->productId,
                'size' => $line->size,
                'color' => $line->color,
                'qty' => $line->qty,
                'sale_price' => $line->productPrice
            ];

            $totalPrice += $line->qty * $line->productPrice;
        }

        $orderInfo = $request->except('_token', 'cart_info');
        $orderInfo['total'] = $totalPrice + 4.5;
        try {
            DB::beginTransaction();
            $order = Order::create($orderInfo);
            $order->orderLines()->createMany($lines);
            DB::commit();
            
            return view('e-commerce.order-complete', compact('order'));
            
            // return redirect()->route('campaigns.index');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }

        dd($request->except('cart_info'), $lines);
    }
}
