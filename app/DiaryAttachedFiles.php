<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaryAttachedFiles extends Model
{
    protected $table = 'diary_attached_files';
    protected $guarded = ['id'];
    protected $fillable = ['event_id', 'trade_id', 'file_path', 'file_name', 'uploader', 'file_number'];   

    public function trade()
    {
        return $this->belongsTo('App\Trade');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
