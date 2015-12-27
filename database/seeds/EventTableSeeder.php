<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Event;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event')->delete();

        Event::create([
            'name' => 'SITCON 2016',
            'event_at' => '2016-02-27'
        ]);
    }
}
