<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhac extends Model
{
    use HasFactory;
    protected $table = "nhac";
    protected $primaryKey = "id";
    public $timestamps = true;
}