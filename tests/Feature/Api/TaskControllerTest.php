<?php

namespace Tests\Feature\Api;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * Feature-тесты для Task API.
 *
 * Проверяет CRUD операции:
 * - Список задач
 * - Создание задачи
 * - Просмотр задачи
 * - Обновление задачи
 * - Удаление задачи
 * - Валидацию обязательных полей
 */

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    /** Проверяет, что API возвращает список всех задач */
    public function it_can_list_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertOk() ->assertJsonCount(3);
    }

    #[Test]
    /** Проверяет успешное создание задачи через API */
    public function it_can_create_a_task()
    {
        $payload = [
            'title' => 'Test Task',
            'description' => 'Some description',
            'status' => 'pending',
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertCreated()
            ->assertJsonFragment(['title' => 'Test Task']);

        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    #[Test]
    /** Проверяет возможность просмотра отдельной задачи */
    public function it_can_show_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertOk()
            ->assertJsonFragment(['id' => $task->id]);
    }

    #[Test]
    /** Проверяет возможность обновления задачи через API */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create();

        $payload = [
            'title' => 'Updated title',
            'description' => 'Updated desc',
            'status' => 'completed',
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $payload);

        $response->assertOk()
            ->assertJsonFragment(['title' => 'Updated title']);

        $this->assertDatabaseHas('tasks', ['title' => 'Updated title']);
    }

    #[Test]
    /** Проверяет возможность удаления задачи через API */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    #[Test]
    /** Проверяет валидацию обязательного поля title при создании задачи */
    public function it_validates_required_fields_when_creating()
    {
        $response = $this->postJson('/api/tasks', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }
}
