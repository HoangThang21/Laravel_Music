<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "user";
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
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $latestRecord = static::latest()->first();
    //         if ($latestRecord) {
    //             preg_match('/\d+$/', $latestRecord->id, $matches); // Trích xuất số từ custom_id
    //             $lastId = isset($matches[0]) ? (int)$matches[0] : 0;
    //             $model->id = 'user' . ($lastId + 1);
    //         } else {
    //             $model->id = 'user1';
    //         }
    //     });
    // }
}