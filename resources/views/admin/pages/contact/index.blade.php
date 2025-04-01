@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Контакты</h1>

        <table class="table table-striped table-lg">
            <thead>
            <tr>
                <th>Номер</th>
                <th>Инстаграм</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <div class="mb-3">
                <a href="{{ route('contact_create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Создать
                </a>
            </div>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->instagram }}</td>
                    <td>
                        <a href="{{ route('contact_edit', $contact->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('contact_delete', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#confirmDelete{{ $contact->id }}">
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include ('admin.layouts.pagination', ['items' => $contacts])
    </div>
    @foreach ($contacts as $contact)
        <div class="modal fade" id="confirmDelete{{ $contact->id }}" tabindex="-1" role="dialog"
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
                        Вы уверены, что хотите удалить эту запись?
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('contact_delete', [$contact->id]) }}">
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
