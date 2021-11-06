<?php

namespace Database\Factories;

use App\Models\Organ;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organ::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'ward_id' => $this->faker->numberBetween(1,579),
        ];
    }
}
