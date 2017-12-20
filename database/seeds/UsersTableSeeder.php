<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        factory(App\Models\User::class)->create([
           'name' => 'demo',
           'username' => 'demo',
           'email' => 'demo@gmail.com',
           'password' => bcrypt('demo'),
           'role' => 'super-admin'
        ]);
    }
}