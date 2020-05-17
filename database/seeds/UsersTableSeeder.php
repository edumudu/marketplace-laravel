<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 40)->create()->each(function($user) {
          $user->store()->save(factory(\App\Store::class)->make());
        });
    }
}
