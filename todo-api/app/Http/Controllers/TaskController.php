<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 一覧表示
    public function index()
    {
        return Task::latest()->get();
    }

    // 保存
    public function store(Request $request)
    {
        $task = Task::create($request->only('title'));
        return response()->json($task, 201);
    }

    // 更新（完了/未完了の切り替えなど）
    public function update(Request $request, Task $task)
    {
        $task->update($request->only('is_done'));
        return $task;
    }

    // 削除
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Deleted']);
    }
}