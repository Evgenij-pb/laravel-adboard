@extends('layouts.template')

@section('content')
    <div class="add-form-conteiner">
        <h2>Изменить объявление</h2>

        @include('common.errors')
        <form class="" action="{{route('myaccount.ad.update', $ad->id)}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="add-create-update-form-group">
                <label for="title" class="">Укажите название:</label>
                <div class="add-form-input-div">
                    <input type="text" name="title" id="title" class="" value="{{old('title') ?? $ad->title}}">
                </div>
            </div>

            <div class="add-create-update-form-group">
                <label for="category" class="">Категория:</label>
                <div class="add-form-input-div">
                    <select name="category" id="category" >
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id===$ad->category_id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="add-create-update-form-group">
                <label for="image" class="">Фото:</label>

                <div class="add-form-input-div">
                    <div>
                        <div>
                            <img class="add-form-preview-image" src="{{$ad->image}}" alt="image">
                        </div>
                        <div>
                            <input type="file" name="image" id="image" accept="image/*" >
                        </div>
                    </div>

                </div>
            </div>

            <div class="add-create-update-form-group">
                <label for="description" class="">Описание:</label>

                <div class="add-form-input-div">
                    <textarea name="description" id="description" cols="" rows="10" class="">{{old('description') ?? $ad->description}}</textarea>
                </div>
            </div>

            <div class="add-create-update-form-group">
                <label for="price" class="">Цена, грн:</label>

                <div class="add-form-input-div">
                    <input type="text" name="price" id="price" class="" value="{{old('price') ?? $ad->price}}">
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