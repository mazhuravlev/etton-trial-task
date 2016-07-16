@extends('shop.layout')
@section('content')
    @if(count($basketItems))
        <h1>Моя корзина</h1>
        <ul class="list-group">
            @foreach($basketItems as $basketItem)
                <li class="list-group-item">
                    {{$basketItem->item->title}}: {{$basketItem->quantity}}
                </li>
            @endforeach
        </ul>
        <form method="post" action="/shop/basket/place_order">
            {!! csrf_field() !!}
            <button type="submit" class="btn btn-primary">Оформить заказ</button>
        </form>
    @else
        <h1>Корзина пуста</h1>
        Товары можно найти в <a href="/shop">каталоге</a>.
    @endif
@endsection