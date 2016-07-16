<?php

namespace App\Http\Controllers\Shop;

use App\Models\BasketItem;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BasketController extends Controller
{

    public function index()
    {
        return view('shop.basket')->with(
            [
                'basketItems' => Auth::user()->basketItems,
            ]
        );
    }

    public function addToBasket(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|integer'
        ]);
        $itemId = $request->get('item_id');
        $item = Item::findOrFail($itemId);
        $quantity = $request->get('quantity');
        /** @var User $user */
        $user = Auth::user();
        /** @var BasketItem $basketItem */
        if ($basketItem = $user->basketItems()->where('item_id', $itemId)->first()) {
            $basketItem->update(['quantity' => $basketItem->quantity + $quantity]);
        } else {
            $basketItem = new BasketItem(['quantity' => $quantity]);
            $basketItem->user()->associate($user);
            $basketItem->item()->associate($item);
            $basketItem->save();
        }
        return response()->json($basketItem);
    }

    public function placeOrder()
    {
        /** @var User $user */
        $user = Auth::user();
        $order = new Order();
        $order->user()->associate($user);
        $order->items_count = 0;
        $order->save();
        foreach ($user->basketItems as $basketItem) {
            /** @var BasketItem $basketItem */
            $orderItem = new OrderItem(['quantity' => $basketItem->quantity]);
            $orderItem->item()->associate($basketItem->item);
            $orderItem->order()->associate($order);
            $orderItem->save();
            $basketItem->delete();
            $order->items_count += $basketItem->quantity;
        }
        $order->save();
        return redirect('shop/orders');
    }
}
