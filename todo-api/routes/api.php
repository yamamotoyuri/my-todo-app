<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// これだけで「一覧取得・作成・更新・削除」のURLが自動で作られます
Route::apiResource('tasks', TaskController::class);