<?php

namespace Database\Factories;

use App\Models\Verify;
use Illuminate\Database\Eloquent\Factories\Factory;

class VerifyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Verify::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => $this->faker->image(storage_path('/app/public/verifies'),400, 400, 'cats', false)
        ];
    }
}
