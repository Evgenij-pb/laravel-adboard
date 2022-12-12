@extends('layouts.admin_template')

@section('content')
    <div class="user-aadd-show-page-container">

        <div class="all-aadd-row">
            Все объявления
        </div>

        @foreach ($ads as $ad)
            <div class="user-aadds-show-container">

                <div class="user-aadd-photo-and-description">

                    <div class="">
                        <img class="user-aadd-show-image" src="{{$ad->image}}" height="" width="" alt="">
                    </div>
                    <div class="user-aadd-show-description">
                        <div class="user-aadd-show-title-and-price">
                            <div class="user-aadd-show-title">
                                <a href="{{route('admin.ad.show',$ad->id)}}">
                                    {{ mb_strimwidth($ad->title,0,65,"...") }}
                                </a>
                            </div>
                            <div class="user-aadd-show-price">{{ $ad->price }}&nbspгрн</div>
                        </div>
                        <div class="user-aadd-show-category">рубрика - {{ $ad->category->name }}</div>
                        <div class="user-aadd-show-owner">
                            автор - <span class="owner-name">{{ $ad->user->name }}</span>
                        </div>
                        <div class="user-aadd-show-date">
                            cрок действия: {{ date_format($ad->created_at, 'd.m.Y') }}  - {{ date_format(new DateTime($ad->expires_at), 'd.m.Y') }}
                        </div>

                    </div>
                </div>
                <div class="user-aadd-show-footer " >
                    <div>cтатус:

                        @if($ad->is_verified)
                            <span class="add-active">проверено</span>
                        @else
                            <span class="add-blocked">ожидает проверку / заблокировано</span>
                        @endif

                        @if(strtotime($ad->expires_at) < time())
                            <span class="add-expire">срок публикации истек</span>
                        @endif

                    </div>

                    <div class="user-aadd-show-btn">
                        <form action="{{ route('AdApprove',$ad->id)}}" method="post">
                            <button>
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                Разрешить / Заблокировать
                            </button>
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                        </form>
                        <form action="{{ route('admin.ad.edit',$ad->id) }}" method="post">
                                <button>
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    Редактировать
                                </button>
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                        </form>
                        <form action="{{ route('admin.ad.destroy',$ad->id) }}" method="post">
                                <button>
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