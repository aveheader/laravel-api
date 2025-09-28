<?php

namespace Database\Factories;

use App\Enum\Status;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->optional()->paragraph,
            'status' => $this->faker->randomElement(Status::cases())->value,
        ];
    }
}
