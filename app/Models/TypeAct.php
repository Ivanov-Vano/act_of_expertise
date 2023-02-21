<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAct extends Model
{
    use HasFactory;

    protected $fillable =[
        'short_name',
        'name',
        'text1',
        'text2'
    ];

}
