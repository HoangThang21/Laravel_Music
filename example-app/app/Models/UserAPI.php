<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class UserAPI extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Billable;
    protected $table = "user_a_p_i";
    protected $primaryKey = "id";
    public $timestamps = true;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
 
   protected $fillable = [
       'name',
       'email', // Thêm email vào fillable
       'password',
       'quyen',
       'trangthai',
   ];
   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = [
       'password',
       'remember_token',
   ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
       'email_verified_at' => 'datetime',
       'password' => 'hashed',
   ];
    
}