<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Display the quiz view
    public function index(){
        return view('questions.quiz');
    }

    // Retrieve a question by its index
    public function getQuestion($index){
        $question = Question::with('answers')->skip($index)->first();

        if (!$question) {
            return response()->json(['message' => 'End of quiz'], 200);
        }

        return response()->json($question);
    }

    // Fetch random questions from various categories
    public function getRandomQuestions() {
        $categories = ['Art', 'History', 'Geography', 'Science', 'Sports'];
        $questions = collect();

        foreach ($categories as $category) {
            $question = Question::with('answers')->where('category', $category)->inRandomOrder()->first();
            if ($question) {
                $questions->push($question);
            }
        }

        $remainingQuestions = Question::with('answers')
                                      ->whereNotIn('id', $questions->pluck('id')->toArray())
                                      ->inRandomOrder()
                                      ->take(20 - $questions->count())
                                      ->get();

        $allQuestions = $questions->merge($remainingQuestions);
        return response()->json($allQuestions);
    }

    // Handle the submission of an answer
    public function submitAnswer(Request $request){
        \Log::info('Answer received:', $request->all());
        $answerId = $request->input('answer_id');
        $answer = Answer::with('question')->find($answerId);
        
        if ($answer) {
            $question = $answer->question;
            $user = auth()->user();
            $categoryColumn = strtolower($question->category); 
            [$correct, $total] = explode('/', $user->$categoryColumn);
            $total++;

            if ($answer->correct == 1) {
                $user->xp += $question->xp;
                $correct++;
            }

            $user->$categoryColumn = "$correct/$total";
            $user->save();

            return response()->json(['message' => 'Answer submitted successfully', 'xp' => $user->xp]);
        }

        return response()->json(['message' => 'Answer not found or invalid'], 400);
    }

    // Handle the submission of the quiz
    public function submitQuiz(Request $request){   
        \Log::info('Quiz answers received:', $request->all());
        $user = auth()->user();
        $answers = $request->input('answers'); 

        $results = [
            'overall' => 0,
            'categories' => [
                'art' => ['correct' => 0, 'total' => 0],
                'geography' => ['correct' => 0, 'total' => 0],
                'history' => ['correct' => 0, 'total' => 0],
                'science' => ['correct' => 0, 'total' => 0],
                'sports' => ['correct' => 0, 'total' => 0]
            ]
        ];

        foreach ($answers as $answerId) {
            $answer = Answer::with('question')->find($answerId);

            if ($answer) {
                $category = strtolower($answer->question->category);
                if (array_key_exists($category, $results['categories'])) {
                    $results['categories'][$category]['total']++;
                    if ($answer->correct) {
                        $results['categories'][$category]['correct']++;
                        $results['overall']++;
                    }
                }
            }
        }

        session(['results' => $results]);

        return response()->json([
            'message' => 'Quiz submitted successfully',
            'redirect_url' => route('quiz.results')
        ]);
    }

    // Display the quiz results
    public function showResults(){
        $results = session('results');
        $user = auth()->user();
        return view('quiz.results', compact('results', 'user'));
    }
}
