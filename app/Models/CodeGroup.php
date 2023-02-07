<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeGroup extends Model
{
    use HasFactory;

    protected $fillable =[
        'number',
        'name',
        'condition'
    ];

}
