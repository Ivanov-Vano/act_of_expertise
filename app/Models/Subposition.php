<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subposition extends Model
{
    use HasFactory;

    protected $fillable =[
        'group',
        'product_position',
        'code',
        'name',
        'group_position',
        'full_code',
        'started_at',
        'position_id'
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id')->withDefault();
    }

    public function getTnVedCodeExt()
    {
        return $this->group.' '.$this->product_position.' '.$this->code;
    }

    public function getTnVedCode(): string
    {
        return $this->group.$this->product_position.$this->code;
    }
}
