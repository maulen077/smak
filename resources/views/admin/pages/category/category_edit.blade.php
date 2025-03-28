@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Редактировать категорию</h1>

        <form method="POST" action="{{ route('category_update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Название:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
            </div>

            <div class="form-group">
                <label for="name_kk">Названия_kk:</label>
                <input type="text" name="name_kk" id="name_kk" class="form-control" value="{{ $category->name_kk }}">
            </div>

            <div class="form-group">
                <label for="name_en">Названия_en:</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{ $category->name_en }}">
            </div>

            <div class="form-group">
                <label for="photo">Изображение:</label>
                <input type="file" name="photo" id="photo" class="form-control-file" accept="image/*">
            </div>


            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
