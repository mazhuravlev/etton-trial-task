@extends('shop.layout')
@section('content')
    @if(count($orders))
        <h1>Мои заказы</h1>
        <div class="btn-group">
            <button data-action="sort" data-field="timestamp" data-direction="1" class="btn btn-default">дата ⇑</button>
            <button data-action="sort" data-field="timestamp" data-direction="-1" class="btn btn-default">дата ⇓
            </button>
            <button data-action="sort" data-field="items_count" data-direction="1" class="btn btn-default">количество
                ⇑
            </button>
            <button data-action="sort" data-field="items_count" data-direction="-1" class="btn btn-default">количество
                ⇓
            </button>
        </div>
        <div id="orders" style="margin-top: 20px;"></div>
    @else
        <h1>Заказов нет</h1>
        Добавьте товары из <a href="/shop">каталога</a> в <a href="/shop/basket">корзину</a>, чтобы сделать заказ.
    @endif

    <script id="ordersTemplate" type="text/x-jsrender">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th></th>
                <th class="text-center">Дата создания</th>
                <th class="text-center">Количество товаров</th>
            </tr>
            <thead>
            <tbody>
                <%for orders%>
                    <tr>
                        <td class="text-center"><a href="/shop/orders/<%:id%>"><span class="glyphicon glyphicon-search"></span></a></td>
                        <td><%:created_at%></td>
                        <td><%:items_count%></td>
                    </tr>
                <%/for%>
            </tbody>
        </table>

    </script>

    <script>
        (function ($) {
            function displayOrders(orders) {
                $('#orders').html(
                        $('#ordersTemplate').render({orders: orders})
                );
            }

            function getSortedOrders(field, direction) {
                var orders = {!! json_encode($orders) !!};
                return orders.sort(function (a, b) {
                    if (a[field] > b[field]) {
                        return direction * 1;
                    } else if (a[field] < b[field]) {
                        return direction * -1;
                    } else {
                        return 0
                    }
                });
            }

            $(document).on('click', 'button[data-action="sort"]', function (e) {
                displayOrders(
                        getSortedOrders(
                                e.target.dataset.field,
                                parseInt(e.target.dataset.direction)
                        )
                );
            });

            $(function () {
                displayOrders(getSortedOrders('timestamp', -1));
            });

        })(jQuery);
    </script>
@endsection