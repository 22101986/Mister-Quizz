@extends('app')

@section('content')

@if($questions->isNotEmpty())
        @foreach ($questions as $question) {{-- Assure-toi de spécifier la variable ici --}}
            <h3>{{ $question->question }}</h3>
            <ul>
                @foreach ($question->answers as $answer)
                    <li>{{ $answer->answer }}</li>
                @endforeach
            </ul>
        @endforeach
    @else
        <p>Aucune question disponible.</p>
    @endif


@endsection