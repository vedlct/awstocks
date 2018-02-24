@extends('main')



@section('content')



    I am inside content

    {{Auth::user()->userId}}

    @endsection