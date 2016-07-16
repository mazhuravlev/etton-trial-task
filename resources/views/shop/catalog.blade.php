@extends('shop.layout')
@section('content')
    <h1>Каталог товаров</h1>
    <div>
        <ul class="list-group">
            @foreach($itemTypes as $itemType)
                <li class="list-group-item">
                    <a class="list-group-item-heading" href="#" data-item-type-id="{{$itemType->id}}"
                       data-action="load_items">{{$itemType->title}}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="itemAddedAlert" class="alert alert-success" style="display: none;">
        Товар добавлен, перейдите в <a href="/shop/basket">корзину</a> для оформления заказа.
    </div>

    <script id="itemTemplate" type="text/x-jsrender">
        <div class="thumbnail">
            <%:title%>
            <form data-action="add_to_basket">
                {!! csrf_field() !!}
        <input name="quantity" type="number" min="1" step="1" value="1">
        <input type="hidden" name="item_id" value="<%:id%>">
        <button type="submit">в корзину</button>
    </form>
</div>

    </script>

    <script>
        (function ($) {
            $(document).on('submit', 'form[data-action="add_to_basket"]', function (e) {
                e.preventDefault();
                var form = e.target;
                $.post(
                        'shop/basket',
                        $(form).serializeArray(),
                        function (data) {
                            $('#itemAddedAlert').slideDown();
                        }
                );
                form.reset();
            });
            $(document).on('click', '*[data-action="load_items"]', function (e) {
                e.preventDefault();
                var node = $(e.target);
                if (node.data('loaded')) {
                    return;
                }
                $.getJSON('shop/item_type/' + e.target.dataset.itemTypeId + '/items', function (data) {
                    node.data('loaded', true);
                    var itemTemplate = $("#itemTemplate");
                    node.after(data.map(function (item) {
                        return itemTemplate.render(item);
                    }));
                });
            });
        })(jQuery);
    </script>
@endsection