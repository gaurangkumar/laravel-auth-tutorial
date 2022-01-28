<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'User',
            'email' => 'user@abc.com',
            'profile' => 'img\avatar-1.jpg',
            'phone' => '9876543210',
            'gender' => 'Male',
            'hobby' => 'Cricket, Chess, Reading',
            'country' => 'India',
            'address' => 'Visnagar',
            'password' => bcrypt('12345678'), //Hash::make('12345678'),
        ]);
    }
}
