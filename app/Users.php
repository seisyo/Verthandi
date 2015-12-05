<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Users extends Model{
    
    protected $table = 'users';
    protected $guarded = ['id'];

    public function users_detail(){

        return $this->hasOne('App\Users_detail', 'id', 'user_id');
    }
}