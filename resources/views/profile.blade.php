@extends('app')

@section('content')

<a class="top-right-corner red-btn" href="{{ route('home') }}">Back ></a>

<div style="margin-top:100px">
    <div class="profile-header">
        <p class="title profile-name">{{ auth()->user()->username }}</p>
        <p class="title profile-email">{{ auth()->user()->email }}</p>
    </div>
    <div class="profile-header">
        <p class="title profile-xp">{{ $rank }}</p>
    </div>

    <div class="profile-header">
        <p class="title profile-xp">{{ auth()->user()->xp }} XP</p>
    </div>
    <div>
    <p class="title profile-xp">CATEGORY: </p>
        
    <p class="title profile-xp">History: {{ auth()->user()->history }}</p>
    <p class="title profile-xp"> {{ $history }}%</p>

    <p class="title profile-xp">Sport: {{ auth()->user()->sports }}</p>
    <p class="title profile-xp"> {{ $sports }}%</p>

    <p class="title profile-xp">Science: {{ auth()->user()->science }}</p>
    <p class="title profile-xp"> {{ $science }}%</p>

    <p class="title profile-xp">Art: {{ auth()->user()->art }}</p>
    <p class="title profile-xp"> {{ $art }}%</p>

    <p class="title profile-xp">Geography: {{ auth()->user()->geography }}</p>
    <p class="title profile-xp"> {{ $geography }}%</p>






    </div>
</div>



@endsection