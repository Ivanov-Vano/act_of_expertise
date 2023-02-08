<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Act extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'date',
        'reason',
        'gross',
        'netto',
        'measure',
        'position',
        'contract',
        'invoice',
        'exporter_id',
        'shipper_id',
        'manufacturer_id',
        'importer_id',
        'consignee_id',
        'cargo',
        'package',
        'description',
        'number',
        'customer_id',
        'type_act_id',
        'expert_id',
    ];
    public function expert():BelongsTo
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

    public function exporter()
    {
        return $this->belongsTo(Organization::class, 'exporter_id');
    }
    public function shipper()
    {
        return $this->belongsTo(Organization::class, 'shipper_id');
    }
    public function manufacturer()
    {
        return $this->belongsTo(Organization::class, 'manufacturer_id');
    }
    public function importer()
    {
        return $this->belongsTo(Organization::class, 'importer_id');
    }
    public function consignee()
    {
        return $this->belongsTo(Organization::class, 'consignee_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
