<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Trade;
use App\Diary;

class TradeDiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trade')->delete();
        DB::table('diary')->delete();

        Trade::create([
            'name' => '支付中研院場地租金',
            'handler' => '劉彥君',
            'comment' => '跟歷年一樣的金額',
            'event_id' => 1,
            'user_id' => 1
        ]);

        Diary::create([
            'direction' => true,
            'amount' => 100000,
            'trade_id' => 1,
            'account_id' => 52110
        ]);
        Diary::create([
            'direction' => false,
            'amount' => 100000,
            'trade_id' => 1,
            'account_id' => 11133
        ]);
    }
}
