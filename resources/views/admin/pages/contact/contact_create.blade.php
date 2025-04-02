@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Создать контакт</h1>

        <form method="POST" action="{{ route('contact_store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="phone">Номер:</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>

            <div class="form-group">
                <label for="instagram">Инстаграм:</label>
                <input type="text" name="instagram" id="instagram" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
@endsection
