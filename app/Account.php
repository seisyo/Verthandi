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

    public function account()
    {
        return $this->hasOne('App\Account', 'id', 'parent_id');
    }

    public function diary()
    {
        return $this->hasMany('App\Diary');
    }

    //original function
    public function parentName()
    {
        if($this->parent_id === '0'){
            return DB::select('select name from account where concat(parent_id,id) = ?', [$this->parent_id])->name;
        }
        
    }
}
