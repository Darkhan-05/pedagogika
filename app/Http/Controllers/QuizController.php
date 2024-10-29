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
        $questions = Question::with(['answers' => function($query) {
            $query->inRandomOrder();
        }])->inRandomOrder()->get();

        return Inertia::render('Quiz', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the leaderboard.
     */
    public function leaderBoard()
    {
        // Получаем данные о лидерах из сессии
        $leaderboard = session()->get('leaderboard', []);

        // Сортируем лидеров по наибольшему проценту в порядке убывания
        usort($leaderboard, function($a, $b) {
            return $b['percentage'] <=> $a['percentage'];
        });

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

        // Получаем имя пользователя (например, из запроса или сессии)
        $username = $request->input('username', 'Аноним');

        // Обновляем таблицу лидеров в сессии
        $leaderboard = session()->get('leaderboard', []);
        $leaderboard[] = [
            'username' => $username,
            'percentage' => $percentage,
            'comment' => $comment,
        ];
        session()->put('leaderboard', $leaderboard);

        return Inertia::render('Result', [
            'percentage' => $percentage,
            'comment' => $comment,
        ]);
    }
}
