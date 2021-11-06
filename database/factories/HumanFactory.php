<?php

namespace Database\Factories;

use App\Models\Human;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;

class HumanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Human::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $wardIDs = Ward::select('id')->where('active', 1)->get();
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'dob' => $this->faker->date(),
            'gender' => rand(1,2) == 1 ? 'Nam' : 'Nữ',
            'hometown' => $this->faker->address(),
            'phone' => $this->faker->randomNumber(),
            'cccd' => $this->faker->randomNumber(),
            'address' => $this->faker->streetAddress(),
            'ward_id' => $wardIDs[rand(0, count($wardIDs) - 1)]->id,
        ];
    }
}
