@extends('root')
@section('layout')
    @include('partials.header')
    <main class="py-4 grow">
        @yield('content')
    </main>
@endsection
