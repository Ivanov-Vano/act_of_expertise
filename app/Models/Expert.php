<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'surname',
        'name',
        'patronymic',
    ];
}
