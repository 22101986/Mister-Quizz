<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LeaderboardController extends Controller
{
    // Display the leaderboard
    public function index()
    {
        // Get the top 10 users sorted by experience points (xp)
        $topUsers = User::select('username', 'xp', 'history', 'sports', 'science', 'art', 'geography')
            ->orderBy('xp', 'desc')
            ->take(10)
            ->get();

        // Calculate total correct answers for each user
        foreach ($topUsers as $user) {
            $user->total_correct_answers = $this->calculateTotalCorrectAnswers($user);
        }

        return view('leaderboard', ['topUsers' => $topUsers]);
    }

    // Calculate total correct answers for a user
    private function calculateTotalCorrectAnswers($user)
    {
        $categories = ['history', 'sports', 'science', 'art', 'geography'];
        $totalCorrect = 0;

        // Loop through categories to sum correct answers
        foreach ($categories as $category) {
            if ($user->$category) {
                $arr = explode('/', $user->$category);
                if (isset($arr[0])) {
                    $totalCorrect += (int)$arr[0];
                }
            }
        }

        return $totalCorrect;
    }
}
