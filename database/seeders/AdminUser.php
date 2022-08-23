<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where('email', 'md.tanvirulislam@outlook.com')->exists()){
            User::create([
                'name' => 'Md Tanvirul Islam',
                'email' => 'md.tanvirulislam@outlook.com',
                'password' => Hash::make('admin_password'),
                'role'  => 'admin'
            ]);
        }
    }
}
