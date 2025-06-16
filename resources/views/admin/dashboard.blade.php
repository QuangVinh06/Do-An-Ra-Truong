@extends('Master.main')

@section('main')


@php
    $user = Auth::guard('admin')->user();
   
    // dd($user);
@endphp
<h1> Chào mừng quay lại </h1>
@endsection