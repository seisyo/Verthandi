<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Users;

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

        Users::create([
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'nickname' => 'seisyo',
            'permission' => 1,
            'status' => 'enable'
        ]);
    }
}
