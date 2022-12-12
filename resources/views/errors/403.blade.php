@extends('layouts.template')

@section('content')
<div class="error-404-box">
    <div>403</div>
    <div class="error-404-message">{{$exceptionMsg ?? 'Нет доступа'}}</div>
</div>
@endsection