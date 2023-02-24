<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class seeder_for_users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
       
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'username' => $faker->userName,
                'avatar' => null,
                'email_verified_at'=>null,
                'remember_token'=>null,
                'email' => $faker->email,
                'password' => Hash::make('user12345'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'isAdmin' => 0,
            ]);
        }
    }
}
