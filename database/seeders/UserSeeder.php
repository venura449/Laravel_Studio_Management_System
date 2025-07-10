<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
          'name' => 'Cashier Profile',
          'email'=>'cashier@cafe-pixel.com',
          'role'=>'cashier',
          'password' => bcrypt('12345678'),
       ]);

        User::create([
            'name' => 'Admin Profile',
            'email'=>'admin@cafe-pixel.com',
            'role'=>'admin',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Designer Profile',
            'email'=>'designer@cafe-pixel.com',
            'role'=>'designer',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Printer Profile',
            'email'=>'printer@cafe-pixel.com',
            'role'=>'printer',
            'password' => bcrypt('12345678'),
        ]);
    }
}
