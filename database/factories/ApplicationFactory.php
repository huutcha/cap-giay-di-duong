<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reason' => rand(1,2) == 1 ? 'Đi làm' : 'Đi học',
            'reason_desc' => $this->faker->sentence(10),
            'email' => $this->faker->freeEmail(),
            'duration' => date("Y-m-d", time() + rand(2000, 20000)),
            'organ_id' => rand(1, 10)
        ];
    }
}
