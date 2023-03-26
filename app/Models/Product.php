<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'act_id',
        'name',
        'brand',
        'manufacturer_id',
        'item_number',
        'gross',
        'netto',
        'measure',
        'origin_criterion',
        'description',
        'code_group_id',
        'subposition_id',
    ];

    public function tnved_code()
    {
        return $this->belongsTo(Subposition::class,'subposition_id')->withDefault();
    }

    public function code_group()
    {
        return $this->belongsTo(CodeGroup::class,'code_group_id');
    }
    public function manufacturer()
    {
        return $this->belongsTo(Organization::class, 'manufacturer_id');
    }
}
