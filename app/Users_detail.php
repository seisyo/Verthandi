<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Users_detail extends Model{
    
    protected $table = 'users_detail';
    protected $fillable = ['user_id', 'first_name', 'last_name', 'email', 'phone'];
    protected $primaryKey  = 'user_id';
    public $timestamps = false;

}