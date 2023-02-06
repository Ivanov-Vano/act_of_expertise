<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'hs_code_id',
        'name',
        'brand',
        'item_number',

    ];
    public function hscode()
    {
        return $this->belongsTo(HsCode::class,'hs_code_id');
    }

}
