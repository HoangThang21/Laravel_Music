<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nghesi extends Model
{
    use HasFactory;
    protected $table = "nghesi";
    protected $primaryKey = "id";
    public $timestamps = true;
}
