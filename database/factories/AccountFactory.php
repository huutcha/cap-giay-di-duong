<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->username(),
            'email' => $this->faker->unique()->freeEmail(),
            'email_verified_at' => now(),
            'role' => $this->faker->numberBetween(1,2),
            'password' => '123', // password
            'remember_token' => Str::random(10),
            'avatar' => $this->faker->image(storage_path('/app/public/avatars'),400, 400, 'cats', false)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
