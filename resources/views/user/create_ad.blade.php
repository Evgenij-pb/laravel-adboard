@extends('layouts.template')

@section('content')
    <div class="add-form-conteiner">
        <h2>Создать объявление</h2>

        @include('common.errors')
        <form class="" action="{{route('myaccount.ad.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="add-create-update-form-group">
                <label for="title" class="">Укажите название:</label>

                <div class="add-form-input-div">
                    <input type="text" name="title" id="title" class="" value="{{old('title')}}">
                </div>
            </div>

            <div class="add-create-update-form-group">
                <label for="category" class="">Категория:</label>
                <div class="add-form-input-div">
                    <select name="category" id="category">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="add-create-update-form-group">
                <label for="image" class="">Фото:</label>

                <div class="add-form-input-div">
                    <input type="file" name="image" id="image" >
                </div>
            </div>

            <div class="add-create-update-form-group">
                <label for="description" class="">Описание:</label>

                <div class="add-form-input-div">
                    <textarea name="description" id="description" cols="" rows="10" class=""></textarea>
                </div>
            </div>

            <div class="add-create-update-form-group">
                <label for="price" class="">Цена, грн:</label>

                <div class="add-form-input-div">
                    <input type="text" name="price" id="price" class="" value="{{old('price')}}">
                </div>
            </div>
                <div class="add-form-btn" >
                    <button type="submit" class="">
                        Сохранить
                    </button>
                </div>


        </form>
    </div>
@endsection