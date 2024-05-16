<?php

namespace App\Models\Subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'created_at',
        'updated_at'
    ];
}
