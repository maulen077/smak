@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Создать новый меню</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('dish_store') }}" enctype="multipart/form-data">
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
                <label for="category_id">Категория:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Выбрать категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="photo">Изображение:</label>
                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">
            </div>

            <div class="form-group">
                <label for="price">Цена:</label>
                <input type="text" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Описание:</label>
                <input type="text" name="description" id="description" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description_kk">Описание_kk:</label>
                <input type="text" name="description_kk" id="description_kk" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description_en">Описание_en:</label>
                <input type="text" name="description_en" id="description_en" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="weight">Вес:</label>
                <input type="text" name="weight" id="weight" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Создать меню</button>
        </form>
    </div>
@endsection
