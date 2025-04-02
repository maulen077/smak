@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Редактировать</h1>

        <form method="POST" action="{{ route('contact_update', $contact->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="phone">Номер:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone ?? null}}">
            </div>

            <div class="form-group">
                <label for="instagram">Инстаграм:</label>
                <input type="text" name="instagram" id="instagram" class="form-control" value="{{ $contact->instagram ?? null}}">
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
