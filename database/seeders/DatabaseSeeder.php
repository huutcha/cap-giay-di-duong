<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Account::factory(10)->create(); //tạo user
        \App\Models\Organ::factory(10)->create();
        \App\Models\Account::factory(10)
                            ->has(\App\Models\Human::factory(), 'human')
                            ->create();
        
        \App\Models\Human::factory(10)
                        ->has(\App\Models\Verify::factory(1), 'verify')
                        ->has(\App\Models\Application::factory(1), 'application')
                        ->create();

        \App\Models\Human::factory(10)
                        ->has(\App\Models\Verify::factory(1), 'verify')
                        ->has(\App\Models\Application::factory(1)
                                ->has(\App\Models\ConfirmHistory::factory(1), 'confirmHistory'),
                            'application'
                        )
                        ->create();
        
        
    }
}
