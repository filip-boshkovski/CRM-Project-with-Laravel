<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $users = collect(User::all()->modelKeys());
        $projects = collect(Project::all()->modelKeys());

        return [
            'title' => fake()->sentence(),
            'description' => fake()->text(22),
            'user_id' => $users->random(),
            'project_id' => $projects->random(),

        ];
    }
}
