<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Account extends Model
{
    protected $table = 'account';
    protected $fillable = ['id', 'name', 'comment', 'parent_id', 'direction'];
    protected $primaryKey = ['id', 'parent_id'];
    public $timestamps = false;

    // public function diary()
    // {
    //     return $this->hasMany('App\Diary');
    // }

    //original function
    public function getParentNameAttribute()
    {
        if($this->parent_id !== 0){
            //parent_id + id = 01 or 00 must be cast to INTEGER like 1 or 0 than can be selected.
            return DB::select('select name from account where cast(concat(parent_id,id) as INTEGER) = ?', [$this->parent_id])[0]->name;
        } else {
            return '';
        }
                
    }
}
