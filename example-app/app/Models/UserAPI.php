<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAPI extends Model
{
    use HasFactory;
    protected $table = "user_a_p_i";
    protected $primaryKey = "id";
    public $timestamps = true;
}
