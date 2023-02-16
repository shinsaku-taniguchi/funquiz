<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\StartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// リダイレクト
Route::redirect('/', '/dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // ログイン後TOP
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // カテゴリ選択画面
    Route::get('/select', [SelectController::class, 'index'])->name('select');

    // クイズスタート画面
    Route::get('/start', [StartController::class, 'index'])->name('start.index');
    Route::post('/start/answer', [StartController::class, 'answer'])->name('start.answer');
    
    // 問題終了画面
    Route::get('/finish', function () {
        return view('finish');
    })->name('finish');

    // お気に入り一覧
    Route::prefix('favorites')->name('favorites.')->group(function () {
        Route::get('/', [FavoriteController::class, 'index'])->name('index'); // お気に入り一覧
        Route::post('/test', [FavoriteController::class, 'test'])->name('test'); // お気に入り追加
        Route::post('/{question}/add', [FavoriteController::class, 'add'])->name('add'); // お気に入り追加
        Route::post('/{question}/remove', [FavoriteController::class, 'remove'])->name('remove'); // お気に入り削除
    });

    // リアクション
    Route::prefix('reactions')->name('reactions.')->group(function () {
        Route::post('/{question}/toggle', [ReactionController::class, 'toggle'])->name('toggle');
    });

    // 一覧、追加、編集
    Route::resources([
        'questions' => QuestionController::class,
    ]);


    Route::prefix('questions')->name('questions.')->group(function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index'); // 問題一覧

        Route::middleware(['can:is_admin'])->group(function () {
            Route::get('/create', [QuestionController::class, 'create'])->name('create'); // 問題作成
            Route::post('/', [QuestionController::class, 'store'])->name('store'); // 問題作成
            Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('edit'); // 問題編集
            Route::put('/{question}', [QuestionController::class, 'update'])->name('update'); // 問題編集
            Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('destroy'); // 問題削除
        });
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
