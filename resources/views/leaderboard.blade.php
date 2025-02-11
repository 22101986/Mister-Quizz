@extends('app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="title text-center mb-4">Leaderboard</h1>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Rank</th>
                                <th scope="col">Username</th>
                                <th scope="col">XP</th>
                                <th scope="col">Total Correct Answers</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topUsers as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->xp }}</td>
                                    <td>{{ $user->total_correct_answers }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-4">
                    
                        <button class="blue-btn" onclick="window.location.href='{{ route('home') }}'">Back to home</button> 
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
