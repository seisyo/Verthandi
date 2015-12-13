<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\UserDetail;

class UserDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_detail')->delete();

        UserDetail::create([
            'user_id' => 1,
            'first_name' => '聖翔',
            'last_name' => '徐',
            'email' => 'seisyo@seisyo.com',
            'phone' => '0912345678'
        ]);
    }
}
