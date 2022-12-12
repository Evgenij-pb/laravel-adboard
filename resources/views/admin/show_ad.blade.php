@extends('layouts.admin_template')

@section('content')

    <div class="show-add-container">
        <div class="show-add-container">
            <div class="user-manage-panel">
                <form action="{{ route('AdApprove',$ad->id) }}" method="post">
                    <button>
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </button>
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                </form>
                <form action="{{ route('admin.ad.edit',$ad->id) }}" method="post">
                    <button type="submit">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                    {{ csrf_field() }}
                    {{ method_field('GET') }}
                </form>
                <form action="{{ route('admin.ad.destroy',$ad->id) }}" method="post">
                    <button type="submit">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
            </div>
        <div class="aadd-show-tiile-box">
            <div class="aadd-show-title">{{ $ad->title }}</div>
            <div>рубрика - {{$ad->category->name}}</div>
        </div>
        <div class="photo-and-contact-box">
            <div>
                <img class="aadd-photo" src="{{$ad->image}}" alt="Фото">
            </div>
            <div class="contact-box">
                <div class="contact-box-header">
                    Пользователь
                </div>

                <div class="user-name"> {{$ad->user->name}}</div>
                <div class="user-registered"> на сайте с {{date_format($ad->user->created_at, 'd-m-Y')}}</div>
                <div> номер телефона</div>
                <div class="user-phone"> {{$ad->user->phone}}</div>
            </div>
        </div>
        <div class="aadd-description-box">
            <div class="aadd-show-createdat">Опубликовано {{date_format($ad->created_at, 'd-m-Y H:i')}}</div>

            <div class="aadd-show-price">Цена {{ $ad->price }} грн</div>
            <div class="aadd-description-header">Описание  </div>
            <div class="aadd-show-description"> {{ $ad->description }}</div>
        </div>
    </div>


@endsection