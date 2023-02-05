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
        'date',
    ];
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeAct::class, 'type_act_id');
    }

    public function customer()
    {
        return $this->belongsTo(Organization::class, 'customer_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
