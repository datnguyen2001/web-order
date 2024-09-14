@extends('web.index')
@section('title','Về chúng tôi')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content ">
        <div class="content-about custom-shadow">
            <p class="title-about">Về chúng tôi</p>
            <div class="content-about-detail">
                {!! $data->about_shop !!}
            </div>
        </div>


    </div>
@stop
@section('script_page')

@stop
