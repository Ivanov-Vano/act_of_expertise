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
        'expert_id',
        'type_act_id',
        'customer_id',
        'number',
        'date',
        'reason',
        'gross',
        'netto',
        'measure_id',
        'position',
        'contract',
        'invoice',
        'exporter_id',
        'shipper_id',
        'importer_id',
        'consignee_id',
        'cargo',
        'package',
        'description',
        'transport_id',
    ];

    public function expert():BelongsTo
    {
        return $this->belongsTo(Expert::class);
    }

    public function transport():BelongsTo
    {
        return $this->belongsTo(Transport::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeAct::class, 'type_act_id');
    }

    public function measure():BelongsTo
    {
        return $this->belongsTo(Measure::class);
    }

    //заказчик
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'customer_id');
    }

    //экспортер
    public function exporter(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'exporter_id');
    }

    //Грузоотправитель
    public function shipper(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'shipper_id');
    }

    //Импортер
    public function importer(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'importer_id');
    }

    //Грузополучатель
    public function consignee(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'consignee_id');
    }
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function attachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Attachment::class);
    }
}
