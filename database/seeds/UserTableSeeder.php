<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        User::query()->truncate(); // truncate user table each time of seeders run
        User::create([ // create a new user
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'name' => 'Administrator'
        ]);
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('secret'),
            ]);
        }
    }
}
