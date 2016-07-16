<?php

namespace App\Http\Controllers\Shop;


use App\Http\Controllers\Controller;
use App\Models\ItemType;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    public function catalog()
    {
        return view('shop.catalog')->with(
            [
                'itemTypes' => ItemType::all(),
            ]
        );
    }

    public function orders()
    {
        $orders = Auth::user()->orders;
        $ordersData = [];
        foreach ($orders as $order) {
            array_push(
                $ordersData,
                [
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

    public function itemsForType(ItemType $itemType)
    {
        return response()->json($itemType->items);
    }

}
