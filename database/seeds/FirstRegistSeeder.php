<?php

use Illuminate\Database\Seeder;

class FirstRegistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
          'employee_code' => '01',
          'name' => '管理者',
          'email' => 'admin@test.com',
          'password' => Hash::make('admin'),
          'role' => 1,
          'sum_rest_time' => '0',
        ]
        ]); 
    }
}
