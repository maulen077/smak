@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Список меню</h1>

        <table class="table table-striped table-lg">
            <thead>
            <tr>
                <th>Название</th>
                <th>Название_kk</th>
                <th>Название_en</th>
                <th>Категория</th>
                <th>Фото</th>
                <th>Цена</th>
                <th>Описание</th>
                <th>Описание_kk</th>
                <th>Описание_en</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <div class="mb-3">
                <a href="{{ route('dish_create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Создать
                </a>
            </div>
            @foreach ($dishes as $dish)
                <tr>
                    <td>{{ $dish->name }}</td>
                    <td>{{ $dish->name_kk }}</td>
                    <td>{{ $dish->name_en }}</td>
                    <td>{{ $dish->category->name }}</td>
                    <td>
                        <img src="{{ $dish->photo }}" alt="Cover" width="100">
                    </td>
                    <td>{{ $dish->price }}</td>
                    <td>{{ $dish->description }}</td>
                    <td>{{ $dish->description_kk }}</td>
                    <td>{{ $dish->description_en }}</td>
                    <td>
                        <a href="{{ route('dish_edit', $dish->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('dish_delete', $dish->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#confirmDelete{{ $dish->id }}">
                                Удалить
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dish_recommend', $dish->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn {{ $dish->is_recommend ? 'btn-success' : 'btn-secondary' }}">
                                {{ $dish->is_recommend ? 'Рекомендовано' : 'Рекомендовать' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include ('admin.layouts.pagination', ['items' => $dishes])
    </div>

    @foreach ($dishes as $dish)
        <div class="modal fade" id="confirmDelete{{ $dish->id }}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы уверены, что хотите удалить?
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('dish_delete', [$dish->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
