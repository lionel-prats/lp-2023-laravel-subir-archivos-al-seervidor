<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'name',
        'code_name',
        'user_id'
    ];
    use HasFactory;
}
