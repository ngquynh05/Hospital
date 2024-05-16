<?php

namespace App\Models\ThongTinKhamBenh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinKhamBenh extends Model
{
    use HasFactory;
    protected $table = 'thong_tin_kham_benh';
    protected $fillable = [
        'user_id',
        'subject_id',
        'schedule_id',
        'date',
        'status',
        'url',
        'created_at',
        'updated_at'
    ];
}
