@extends('app')

@section('content')

@auth
<a class="top-left-corner blue-btn" href="{{ route('profile') }}">{{ auth()->user()->username }}</a>
@endauth

@guest
<a class="top-left-corner blue-btn" href="{{ route('login') }}">Login</a>
@endguest

<a class="top-right-corner blue-btn" href="{{ route('leaderboard') }}">Leaderboard</a>

@auth
<a class="bottom-right-corner red-btn" href="{{ route('logout') }}">Logout</a>
@endauth

<div class="main-img">
    <img src="{{ asset('images/mister_quiz.png') }}" alt="">
    <p class="title">Mister Quiz</p>

    @auth
    <a style="margin-bottom:20px" class="green-btn center" href="{{ url('/quiz') }}">Start Quiz</a>
    @endauth

    @guest
    <a style="margin-bottom:20px" class="green-btn center" href="{{ route('login') }}">Start Quiz (Login Required)</a>
    @endguest
</div>

@endsection
