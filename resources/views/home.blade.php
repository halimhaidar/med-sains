<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    @auth
        <h1>Welcome, {{ Auth::user()->fullname }}</h1>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <h1>You are not logged in.</h1>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
@endsection
