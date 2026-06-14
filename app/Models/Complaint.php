<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_name',
        'description',
        'category',
        'latitude',
        'longitude',
        'status',
        'image',
        'user_id',
    ];
}
