@extends('layouts.template')

@section('content')

    <div class="search-row-box">
        <form class="search-form" action="{{ route('search') }}">
            <input type="text" name="search" placeholder="Поиск по объявлениям" value="{{request()->search}}">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                Поиск
            </button>
        </form>
    </div>

    <div class="search-result-row">

    @if($ads->count()>0)
        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
            Результаты поиска
        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
    @else
        Ничего не найдено
    @endif

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
                <div class="aadd-category">{{ $ad->category->name }}</div>
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

    {{$ads->appends(['search'=>request()->search])->links()}}
@endsection