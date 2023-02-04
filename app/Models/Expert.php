<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'surname',
        'name',
        'patronymic',
        'sign_path'
    ];
    public function acts()
    {
        return $this->hasMany(Act::class);
    }
    public function getFio()
    {
        return $this->surname.' '.mb_substr($this->name, 0, 1).'. '.mb_substr($this->patronymic, 0, 1).'.';;
    }
}
