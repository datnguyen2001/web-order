@extends('tracking.master')

@section('content')
    @include('tracking.partials.header')

    <!-- Body: Body -->
    @include('tracking.partials.search')

    <!-- Modal Custom Settings-->
    @include('tracking.partials.tracking_details')
@endsection
