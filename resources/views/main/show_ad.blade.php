@extends('layouts.template')

@section('content')

<div class="show-add-container">
    <div class="aadd-show-tiile-box">
        <div class="aadd-show-title">{{ $ad[0]->title }}</div>
        <div>рубрика - {{$ad[0]->category->name}}</div>
    </div>
    <div class="photo-and-contact-box">
        <div>
            <img class="aadd-photo" src="{{$ad[0]->image}}" alt="Фото">
        </div>
        <div class="contact-box">
            <div class="contact-box-header">
                Пользователь
            </div>

            <div class="user-name"> {{$ad[0]->user->name}}</div>
            <div class="user-registered"> на сайте с {{date_format($ad[0]->user->created_at, 'd-m-Y')}}</div>
            <div> номер телефона</div>
            <div class="user-phone"> {{$ad[0]->user->phone}}</div>
        </div>
    </div>
    <div class="aadd-description-box">
        <div class="aadd-show-createdat">Опубликовано {{date_format($ad[0]->created_at, 'd-m-Y H:i')}}</div>

        <div class="aadd-show-price">Цена {{ $ad[0]->price }} грн</div>
        <div class="aadd-description-header">Описание  </div>
        <div class="aadd-show-description"> {{ $ad[0]->description }}</div>
    </div>
</div>

@endsection