@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Редактировать меню</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('dish_update', $dish->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $dish->name }}">
            </div>

            <div class="form-group">
                <label for="name_kk">Названия_kk:</label>
                <input type="text" name="name_kk" id="name_kk" class="form-control" value="{{ $dish->name_kk }}">
            </div>

            <div class="form-group">
                <label for="name_en">Названия_en:</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $dish->name_en }}">
            </div>

            <div class="form-group">
                <label for="photo">Изображение:</label>
                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">
            </div>

            <div class="form-group">
                <label for="price">Цена:</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ $dish->price }}">
            </div>

            <div class="form-group">
                <label for="description">Описание:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $dish->description }}">
            </div>

            <div class="form-group">
                <label for="description_kk">Описание_kk:</label>
                <input type="text" name="description_kk" id="description_kk" class="form-control" value="{{ $dish->description_kk }}">
            </div>

            <div class="form-group">
                <label for="description_en">Описание_en:</label>
                <input type="text" name="description_en" id="description_en" class="form-control" value="{{ $dish->description_en }}">
            </div>

            <div class="form-group">
                <label for="weight">Вес:</label>
                <input type="text" name="weight" id="weight" class="form-control" value="{{ $dish->weight }}">
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
