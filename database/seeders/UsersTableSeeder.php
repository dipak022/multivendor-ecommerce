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
                'full_name'=> 'Dipak User',
                'username'=> 'User',
                'email'=> 'user@gmail.com',
                'password'=>Hash::make('11111111'),
                'role'=> 'customer',
                'status'=> 'active',

            ],
        
            ]);

        \DB::table('admins')->insert([
            //vendor 
            [
                'full_name'=> 'Dipak admin',
                'email'=> 'admin@gmail.com',
                'password'=>Hash::make('11111111'),
                //'role'=> 'admin',
                'status'=> 'active',

            ],
        
            ]);
                
                
            \DB::table('sellers')->insert([
                //customer
                [
                    'full_name'=> 'Dipak seller',
                    'username'=> 'seller',
                    'email'=> 'seller@gmail.com',
                    'password'=>Hash::make('11111111'),
                    //'role'=> 'seller',
                    'status'=> 'active',

                ],
            
            ]);    

              
             
           
    }
}
