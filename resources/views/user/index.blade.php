@extends('layouts.template')

@section('content')
    <div class="user-aadd-show-page-container">

    <div class="all-aadd-row">
        Ваши объявления, всего {{$adsCount}}
    </div>

        @foreach ($ads as $ad)
            <div class="user-aadds-show-container">

                <div class="user-aadd-photo-and-description">

                    <div class="">
                        <img class="user-aadd-show-image" src="{{$ad->image}}" height="130" width="" alt="">
                    </div>
                    <div class="user-aadd-show-description">
                        <div class="user-aadd-show-title-and-price">
                            <div class="user-aadd-show-title">
                                <a href="{{route('myaccount.ad.show',$ad->id)}}">
                                    {{ mb_strimwidth($ad->title,0,65,"...") }}                                </a>
                            </div>
                            <div class="user-aadd-show-price">{{ $ad->price }}&nbspгрн</div>
                        </div>
                        <div class="user-aadd-show-category">рубрика - {{ $ad->category->name }}</div>
                        <div class="user-aadd-show-date">
                            cрок действия: {{ date_format($ad->created_at, 'd.m.Y') }}  - {{ date_format(new DateTime($ad->expires_at), 'd.m.Y') }}
                        </div>

                    </div>
                </div>
                <div class="user-aadd-show-footer " >
                    <div>cтатус:

                        @if(!$ad->is_verified)
                            <span class="add-blocked">ожидает проверку / заблокировано</span>
                        @else
                            <span class="add-active">одобрено</span>
                        @endif

                        @if(strtotime($ad->expires_at) < time())
                            <span class="add-expire">срок публикации истек</span>
                        @endif

                    </div>
                    <div class="user-aadd-show-btn">
                        <form action="{{ route('AdExtend',$ad->id) }}" method="post">
                                <button>
                                    <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                    Продлить
                                </button>
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                        </form>
                        <form action="{{ route('myaccount.ad.edit',$ad->id) }}" method="post">
                                <button type="submit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Редактировать
                                </button>
                            {{ csrf_field() }}
                            {{ method_field('GET') }}
                        </form>
                        <form action="{{ route('myaccount.ad.destroy',$ad->id) }}" method="post">
                                <button type="submit">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Удалить
                                </button>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </div>
                </div>
            </div>
        @endforeach


    {{$ads->links()}}
    </div>
@endsection