<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Inertia\Inertia;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with(['answers' => function ($query) {
            $query->inRandomOrder();
        }])->inRandomOrder()->get();

        return Inertia::render('Quiz', [
            'questions' => $questions,
            // 'user_id' => auth()->id(),
        ]);
    }

    /**
     * Show the leaderboard.
     */
    public function leaderBoard()
    {
        // Получаем топ-10 пользователей с наибольшими баллами
        $leaderboard = \App\Models\User::select('name', 'score')
            ->whereNotNull('score')
            ->orderByDesc('score')
            ->limit(10)
            ->get();

        return Inertia::render('LeaderBoard', [
            'leaderboard' => $leaderboard,
        ]);
    }


    /**
     * Show quiz results and update leaderboard.
     */
    public function results(Request $request)
    {
        $score = $request[0]['results']['score'];
        $totalQuestions = $request[0]['results']['totalQuestions'];
        $percentage = ceil(($score / $totalQuestions) * 100);

        $comment = match (true) {
            $percentage >= 80 && $percentage <= 100 => 'Құттықтаймыз',
            $percentage >= 60 && $percentage <= 79 => 'Мәссасаған',
            $percentage >= 40 && $percentage <= 59 => 'Өкінбе!',
            $percentage < 39 => 'Ох',
            default => 'Қалай мұнда келдің?'
        };

        // Получаем текущего пользователя
        $user = auth()->user();

        // Обновляем результат пользователя в базе данных
        if ($user) {
            $user->score = $percentage;
            $user->save();
        }

        return Inertia::render('Result', [
            'percentage' => $percentage,
            'comment' => $comment,
        ]);
    }
}
