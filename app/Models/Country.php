<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'capital',
        'title'
    ];

    public function scopeIndexList($query)
    {
        return $query->orderBy('title')->get(['title', 'capital', 'created_at']);
    }

    public function statistic()
    {
        return $this->hasOne(Statistic::class);
    }
}
