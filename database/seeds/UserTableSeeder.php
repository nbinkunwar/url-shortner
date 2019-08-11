<?php

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
        $user = new \App\User();
        $user->name = 'Nabin Kunwar';
        $user->email = 'admin@admin.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('password');
        $user->save();
    }
}
