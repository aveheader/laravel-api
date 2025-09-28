<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

/**
 * Task API Controller
 *
 * Обрабатывает все CRUD операции для задач через REST API.
 */
class TaskController extends Controller
{
    /**
     * Получить список всех задач
     */
    public function index(): JsonResponse
    {
        $tasks = Task::all();

        return response()->json(TaskResource::collection($tasks));
    }

    /**
     * Создать новую задачу
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        return response()->json(new TaskResource($task), 201);
    }

    /**
     * Получить конкретную задачу по ID
     */
    public function show(Task $task): JsonResponse
    {
        return response()->json(new TaskResource($task));
    }

    /**
     * Обновить существующую задачу
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json(new TaskResource($task));
    }

    /**
     * Удалить задачу
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(null, 204);
    }
}
