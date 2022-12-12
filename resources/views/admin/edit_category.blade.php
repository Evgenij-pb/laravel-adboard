@extends('layouts.admin_template')

@section('content')
    <div class="add-category-page">
        <div class="add-category-form-box">
            @include('common.errors')
            <form action="{{route('admin.category.update',$category->id)}}" method="POST" class="add-category-form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}


                <div class="add-category-field-group">
                    <label for="category" class="">Название категории:</label>


                    <input type="text" name="name" id="category" class="" value="{{old('name') ?? $category->name}}">

                    <button type="submit" class="">
                        Изменить
                    </button>
                </div>
            </form>

        </div>
@endsection