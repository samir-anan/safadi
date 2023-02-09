<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Mohammed Safadi',
            'email' => 'admin@app.com',
            'password' => Hash::make('123456'),
            'phone_number' => '0599100100',
        ]);

        DB::table('users')->insert(
            [
                'name' => 'System Admin',
                'email' => 'sys@safadi.ps',
                'password' => Hash::make('password'),
                'phone_number' => '0599200200',
            ]
        );
    }
}
