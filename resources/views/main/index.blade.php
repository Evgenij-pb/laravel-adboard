@extends('layouts.template')

@section('content')
    <div class="search-row-box">
        <form class="search-form" action="{{ route('search') }}">
            <input type="text" name="search" placeholder="Поиск по объявлениям">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                Поиск</button>
        </form>
    </div>

    <div class="category-container">
        <div class="category-container-header">
            Главные рубрики
        </div>
        <div class="category-box" >
            <div class="category-subbox" >

                @foreach ($categories as $category)
                    <div class="category">
                        <a href="{{route('allInCategory', $category->id)}}">{{ $category->name }}</a>
                    </div>
                @endforeach

            </div>
        </div>
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
            <div class="aadd-category">
                {{ $ad->category->name }}
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