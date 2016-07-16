@extends('shop.layout')
@section('content')
    <style scoped>
        .item {
            margin-bottom: 2px;
        }
        .items {
            padding-left: 20px;
        }
        .item-title {
            display: inline-block;
            width: 200px;
        }
    </style>
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
        <div class="items">
            <%for items%>
                <div class="item">
                    <form data-action="add_to_basket" class="form-inline">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <span class="item-title"><%:title%></span>
                            <input length="2" style="width: 60px;" class="form-control" name="quantity" type="number" min="1" step="1" value="1">
                            <button class="btn btn-default" type="submit">в корзину</button>
                        </div>
                        <input type="hidden" name="item_id" value="<%:id%>">
                    </form>
                </div>
            <%/for%>
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
                $.getJSON('shop/item_type/' + e.target.dataset.itemTypeId + '/items', function (items) {
                    node.data('loaded', true);
                    node.after($("#itemTemplate").render({items: items}));
                });
            });
        })(jQuery);
    </script>
@endsection