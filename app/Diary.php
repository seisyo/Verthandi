<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
