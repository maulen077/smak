@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Создать Категорию</h1>

        <form method="POST" action="{{ route('category_store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name_kk">Название_kk:</label>
                <input type="text" name="name_kk" id="name_kk" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="name_en">Название_en:</label>
                <input type="text" name="name_en" id="name_en" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="photo">Изображение:</label>
                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Создать город</button>
        </form>
    </div>
@endsection
