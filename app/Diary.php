<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class Diary extends Model
{
    use SoftDeletes;

    protected $table = 'diary';
    protected $guarded = ['id'];
    protected $fillable = ['direction', 'amount', 'trade_id', 'account_id', 'account_parent_id'];
    protected $dates = ['deleted_at'];

    public function trade()
    {
        return $this->belongsTo('App\Trade');
    }

    public function getAccountAttribute()
    {
        return DB::select("select RPAD(cast(concat(parent_id,id) as INTEGER),5,'0') as fullId, name from account where id = :id and parent_id = :parent_id", ['id' => $this->account_id, 'parent_id' => $this->account_parent_id])[0];
    }

}
