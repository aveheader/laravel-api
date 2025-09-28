<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Task API Controller
 *
 * Обрабатывает все CRUD операции для задач через REST API.
 */
class TaskController extends Controller
{
    /**
     * Получить список всех задач
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $tasks = Task::paginate(15);
            return response()->json([
                'success' => true,
                'data' => TaskResource::collection($tasks)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving tasks'
            ], 500);
        }
    }

    /**
     * Создать новую задачу
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        return response()->json($task, 201);
    }

    /**
     * Получить конкретную задачу по ID
     *
     * @param Task $task
     * @return JsonResource
     */
    public function show(Task $task): JsonResource
    {
        return new TaskResource($task);
    }

    /**
     * Обновить существующую задачу
     *
     * @param UpdateTaskRequest $request
     * @param Task $task
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json($task, 200);
    }

    /**
     * Удалить задачу
     *
     * @param Task $task
     * @return JsonResponse
     */
    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(null, 204);
    }
}
