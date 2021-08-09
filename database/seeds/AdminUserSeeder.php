<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;$i++)
        {
            DB::table('admin_users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'api_token' => Str::random(10).'@gmail.com',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
