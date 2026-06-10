@extends('root')
@section('layout')
    @include('partials.header')
    <main class="py-4 grow">
        @include('weather')
        @yield('content')
    </main>
@endsection
