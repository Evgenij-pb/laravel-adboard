@extends('layouts.template')

@section('content')
    <div class="category-name-row">
        Всё в рубрике - {{ $categoryName }}
    </div>

    <div class="aadds-container">

        @foreach ($ads as $ad)
            <div class="aadd-box">

                <div class="aadd-image">
                    <img src="{{ $ad->image }}" height="130" width="" alt="">
                </div>
                <div class="aadd-title">
                    <a href="{{route('show',[$ad->category->id, $ad->id])}}">
                        {{ mb_strimwidth($ad->title,0,35,"...") }}
                    </a>
                </div>
                <div class="date-and-price">
                    <div class="aadd=date">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        {{ date_format($ad->created_at, 'd-m-Y H:i') }}
                    </div>
                    <div class="aadd-price">{{ $ad->price }}&nbspгрн</div>
                </div>

            </div>
        @endforeach

    </div>
    {{$ads->links()}}
@endsection