<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiaryAttachedFiles extends Model
{
    use SoftDeletes;

    protected $table = 'diary_attached_files';
    protected $guarded = ['id'];
    protected $fillable = ['event_id', 'trade_id', 'file_path', 'file_name', 'uploader', 'file_number'];
    protected $dates = ['deleted_at'];   

    public function trade()
    {
        return $this->belongsTo('App\Trade');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
