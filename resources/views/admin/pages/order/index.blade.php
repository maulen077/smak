@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>История заказов</h1>

        <table class="table table-striped table-lg">
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Номер телефона</th>
                <th>Тип доставки</th>
                <th>Адрес</th>
                <th>Комментария</th>
                <th>Дата доставки</th>
                <th>Время доставки</th>
                <th>Общяя сумма</th>
                <th>Статус</th>
                <th>Дата создания</th>
{{--                <th>Действия</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->delivery_type }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->comment }}</td>
                    <td>{{ $order->delivery_date }}</td>
                    <td>{{ $order->delivery_time }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>

{{--                    <td>--}}
{{--                        <form action="{{ route('category_delete', $category->id) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="button" class="btn btn-danger" data-toggle="modal"--}}
{{--                                    data-target="#confirmDelete{{ $category->id }}">--}}
{{--                                Удалить--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
        @include ('admin.layouts.pagination', ['items' => $orders])
    </div>
{{--    @foreach ($categories as $category)--}}
{{--        <div class="modal fade" id="confirmDelete{{ $category->id }}" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--            <div class="modal-dialog" role="document">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        Вы уверены, что хотите удалить эту запись?--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <form method="POST" action="{{ route('category_delete', [$category->id]) }}">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="btn btn-danger">Удалить</button>--}}
{{--                        </form>--}}
{{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
@endsection
