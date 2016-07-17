<?php

namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function orders()
    {
        $orders = Auth::user()->orders;
        $ordersData = [];
        foreach ($orders as $order) {
            array_push(
                $ordersData,
                [
                    'id' => $order->id,
                    'created_at' => $order->created_at->format('d.m.Y H:i:s'),
                    'timestamp' => $order->created_at->timestamp,
                    'items_count' => $order->items_count
                ]
            );
        }
        return view('shop.orders')->with(
            [
                'orders' => $ordersData
            ]
        );
    }

  public function showOrder(Order $order) {
      return view('shop.order')->with(
          [
              'order' => $order
          ]
      );
  }

}
