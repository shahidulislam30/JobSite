<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\User::create([
            'id' => 1,
            'first_name' => 'miraj',
            'last_name' => 'khandaker',
            'business_name' => 'UnKnownIt',
            'email' => 'miraj_e@gmail.com',
            'password' => bcrypt(123456),
            'user_type' => 1,
        ]);

        \App\Model\User::create([
            'id' => 2,
            'first_name' => 'miraj',
            'last_name' => 'khandaker',
            'business_name' => '',
            'email' => 'miraj_a@gmail.com',
            'password' => bcrypt(123456),
            'user_type' => 0,
        ]);
    }
}
