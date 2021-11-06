<?php

namespace Database\Factories;

use App\Models\ConfirmHistory;
use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConfirmHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConfirmHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIDs = Account::select('id')->where('role', 3)->get();
        return [
            'state' => rand(1,2) == 1 ? 'cancel' : 'accept',
            'account_id' => $userIDs[rand(0, count($userIDs) - 1)]->id
        ];
    }
}
