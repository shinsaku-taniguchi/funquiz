<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Favorite;
use App\Models\Question;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        
        $user = $request->user();
        $questions = $user->questions()->paginate(10);

        return view('questions.index', [
            'questions' => $questions,
        ]);
    }

    public function test(Request $request)
    {
        return response()->json([
            'result' => true,
        ]);
    }

    public function add(Request $request, Question $question)
    {
        $user = $request->user();
        $user->questions()->attach($question->id);

        return response()->json([
            'result' => true,
        ]);
    }

    public function remove(Request $request, Question $question)
    {
        $user = $request->user();
        $user->questions()->detach($question->id);

        return response()->json([
            'result' => true,
        ]);
    }
}
