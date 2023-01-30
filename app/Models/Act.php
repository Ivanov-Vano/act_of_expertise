<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Act extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'number',
        'name',
        'patronymic',
    ];
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}
