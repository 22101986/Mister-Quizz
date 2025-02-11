@extends('app')

@section('content')
<a class="top-right-corner red-btn" href="{{ route('home') }}">Back ></a>

@if(isset($results) && isset($results['categories']))
    <div class="result">
        <p class="title profile-name">{{ auth()->user()->username }}</p>
    </div>
    <br>

    <div class="result d-block mb-3">
        <p>Total</p>
        <p class="title">{{ $results['overall'] ?? 0 }} / 20</p>
    </div>

    <div class="result d-block mb-3">
        <p>Art</p>
        <p class="title">{{ $results['categories']['art']['correct'] ?? 0 }} / {{ $results['categories']['art']['total'] ?? 0 }}</p>
    </div>

    <div class="result d-block mb-3">
        <p>Geography</p>
        <p class="title">{{ $results['categories']['geography']['correct'] ?? 0 }} / {{ $results['categories']['geography']['total'] ?? 0 }}</p>
    </div>

    <div class="result d-block mb-3">
        <p>History</p>
        <p class="title">{{ $results['categories']['history']['correct'] ?? 0 }} / {{ $results['categories']['history']['total'] ?? 0 }}</p>
    </div>

    <div class="result d-block mb-3">
        <p>Science</p>
        <p class="title">{{ $results['categories']['science']['correct'] ?? 0 }} / {{ $results['categories']['science']['total'] ?? 0 }}</p>
    </div>

    <div class="result d-block mb-3">
        <p>Sports</p>
        <p class="title">{{ $results['categories']['sports']['correct'] ?? 0 }} / {{ $results['categories']['sports']['total'] ?? 0 }}</p>
    </div>

@else
    <p>Les résultats ne sont pas disponibles.</p>
@endif


@endsection
