<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class StartController extends Controller
{
    public function index(Request $request)
    {
        
        // クエリ文字列 "next" の値を取得
        $next = $request->query('next');

        if (is_null($next)) {
            $request->session()->forget('filtered');
        }

        $artistId = $request->input('artist_id');
        if ($artistId) {
            session(['filtered' => [
                'artist_id' => $artistId,
            ]]);
        }
        
        $countryId = $request->input('country_id');
        if ($countryId) {
            session(['filtered' => [
                'country_id' => $countryId,
            ]]);
        }

        $genreId = $request->input('genre_id');
        if ($genreId) {
            session(['filtered' => [
                'genre_id' => $genreId,
            ]]);
        }

        $filtered = session('filtered', []);

        $filteredArtistId = array_key_exists('artist_id', $filtered) ? $filtered['artist_id'] : null;
        $filteredCountryId = array_key_exists('country_id', $filtered) ? $filtered['country_id'] : null;
        $filteredGenreId = array_key_exists('genre_id', $filtered) ? $filtered['genre_id'] : null;

        if ($next) {
            $answeredQuestionIds = session('answered_question_ids', []);

            $questions = Question::when($filteredArtistId, function ($query, $filteredArtistId) {
                $query->where('artist_id', $filteredArtistId);
            })->when($filteredCountryId, function ($query, $filteredCountryId) {
                $query->where('country_id', $filteredCountryId);
            })->when($filteredGenreId, function ($query, $filteredGenreId) {
                $query->where('genre_id', $filteredGenreId);
            })->whereNotIn('id', $answeredQuestionIds)->get();

            if ($questions->count() === 0) {
                $request->session()->forget('answered_question_ids');
                return redirect()->route('finish');
            } else {
                $question = $questions->random();
            }

            $answeredQuestionIds[] = $question->id;

            session(['answered_question_ids' => $answeredQuestionIds]);
        } else {
            
            $questions = Question::when($filteredArtistId, function ($query, $filteredArtistId) {
                $query->where('artist_id', $filteredArtistId);
            })->when($filteredCountryId, function ($query, $filteredCountryId) {
                $query->where('country_id', $filteredCountryId);
            })->when($filteredGenreId, function ($query, $filteredGenreId) {
                $query->where('genre_id', $filteredGenreId);
            })->get();

            if($questions->count() === 0) {
                echo "問題がないためリダイレクトします";
                return redirect()->route('select');
            } else {
                $question = $questions->random();
                session(['answered_question_ids' => [$question->id]]);
            }
        }

        return view('start.index', [
            'question' => $question,
        ]);
    }

    public function answer(Request $request)
    {
        $questionId = $request->input('question_id');
        $userAnswer = (int)$request->input('user_answer');

        $isCorrect = false;

        $question = Question::find($questionId);

        if ($question) {
            // 正解がどうかチェック
            $isCorrect = $question->answer === $userAnswer;
        } else {
            dump('エラーです。');
            abort(500);
        }

        return view('start.answer', [
            'question' => $question,
            'isCorrect' => $isCorrect,
        ]);
    }
}
