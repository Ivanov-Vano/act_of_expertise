<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'short_name',
        'name',
        'inn',
        'phone',
        'address',
        'country_id'
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
