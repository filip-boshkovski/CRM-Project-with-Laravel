<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{

    protected $model = Project::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $users = collect(User::all()->modelKeys());
        $clients = collect(Client::all()->modelKeys());

        return [
            'title' => fake()->sentence(),
            'description' => fake()->text(22),
            'deadline' => fake()->dateTimeBetween('+1 month', '+6 month'),
            'user_id' => $users->random(),
            'client_id' => $clients->random()
        ];
    }
}
