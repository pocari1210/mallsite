<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      //Admin 
      [
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('111'),
        'photo' => '202308181039avatar-1.png',
        'role' => 'admin',
        'status' => 'active',
      ],

      //Vendor 
      [
        'name' => 'Vendor',
        'username' => 'vendor',
        'email' => 'vendor@gmail.com',
        'password' => Hash::make('111'),
        'photo' => '202307150736avatar-10.png',
        'role' => 'vendor',
        'status' => 'active',
      ],

      //User OR Customer  
      [
        'name' => 'User',
        'username' => 'user',
        'email' => 'user@gmail.com',
        'password' => Hash::make('111'),
        'photo' => '202308181039avatar-1.png',
        'role' => 'user',
        'status' => 'active',
      ],
    ]);
  }
}
