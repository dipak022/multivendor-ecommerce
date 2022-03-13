<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    
    /**
     * 
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            // Admin 
            [
                'full_name'=> 'Dipak Admin',
                'username'=> 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> 'admin',
                'status'=> 'active',

            ],
            //vendor 
            [
                'full_name'=> 'Dipak seller',
                'username'=> 'seller',
                'email'=> 'seller@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> 'seller',
                'status'=> 'active',

            ],
            //customer
            [
                'full_name'=> 'Dipak customer',
                'username'=> 'customer',
                'email'=> 'customer@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> 'customer',
                'status'=> 'active',

            ],


            ]);
    }
}
