@extends('shop.layout')
@section('content')
    <h1>Заказ от {{$order->created_at->format('d.m.Y h:i:s')}}</h1>
    <ul class="list-group">
        @foreach($order->orderItems as $orderItem)
            <li class="list-group-item">
                {{$orderItem->item->title}}: {{$orderItem->quantity}}
            </li>
        @endforeach
    </ul>
@endsection