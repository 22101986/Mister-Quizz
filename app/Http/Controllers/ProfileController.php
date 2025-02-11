<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth()->user(); // Get the authenticated user

        // User categories and experience points (xp)
        $categories = [
            'history' => $user->history, 
            'sports' => $user->sports,    
            'science' => $user->science,   
            'art' => $user->art,           
            'geography' => $user->geography 
        ];

        $xp = $user->xp;
        $rank = "";

        // Determine the user's rank based on xp
        if ($xp < 1500) {
            $rank = "Quiz Apprentice";
        } elseif ($xp >= 1500 && $xp < 5000) {
            $rank = "Average Quizer";
        } elseif ($xp >= 5000 && $xp < 10000) {
            $rank = "Epic Quizer";
        } else {
            $rank = "Quiz Master";
        }

        // Calculate the percentage of correct answers for each category
        $percentages = [];
        foreach ($categories as $key => $value) {
            if ($value) {
                $arr = explode('/', $value);
                if (isset($arr[1]) && $arr[1] > 0) { 
                    $percentages[$key] = round(($arr[0] / $arr[1]) * 100);
                } else {
                    $percentages[$key] = 0; 
                }
            } else {
                $percentages[$key] = 0; 
            }
        }

        // Return the profile view with user data
        return view('profile', [
            'art' => $percentages['art'],
            'geography' => $percentages['geography'],
            'history' => $percentages['history'],
            'science' => $percentages['science'],
            'sports' => $percentages['sports'],
            'xp' => $user->xp, 
            'username' => $user->username,
            'email' => $user->email,
            'rank' => $rank
        ]);
    }
}

