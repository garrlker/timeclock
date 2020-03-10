<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
      'name' => 'Spur',
      'email' => 'test@gmail.com',
      'password' => bcrypt('password'),
      'email_verified_at' => Carbon::now(),
      'remember_token' => '',
      'timezone' => 'american/chicago',
      'clocked_in' => 0,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);
  }
}
