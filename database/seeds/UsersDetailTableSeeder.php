<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Users_detail;

class UsersDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_detail')->delete();

        Users_detail::create([
            'user_id' => 1,
            'first_name' => '聖翔',
            'last_name' => '徐',
            'email' => 'seisyo@seisyo.com',
            'phone' => '0912345678'
        ]);

    }
}
