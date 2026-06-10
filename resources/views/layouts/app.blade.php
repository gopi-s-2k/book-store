@extends('root')
@section('layout')
    @include('partials.header')
    <main class="py-4 grow pb-5">
        @include('weather')
        @yield('content')
    </main>
@endsection
