@extends('web.index')
@section('title',$data->name)

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content ">
        <div class="content-about custom-shadow">
            <p class="title-about">{{$data->name}}</p>
            <div class="content-about-detail">
                {!! $data->content !!}
            </div>
        </div>


    </div>
@stop
@section('script_page')

@stop
