<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'short_name',
        'name',
        'registration_number',
        'address',
        'country_id'
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
