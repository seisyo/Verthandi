<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->delete();

        User::create([
            'username' => 'admin',
            'password' => Hash::make('sitconfinancial'),
            'nickname' => 'seisyo',
            'permission' => 1,
            'status' => 'admin'
        ]);
    }
}
