<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiStatus extends Model
{
    use HasFactory;

    protected $fillable = ['api_name', 'status', 'last_checked', 'message'];
}