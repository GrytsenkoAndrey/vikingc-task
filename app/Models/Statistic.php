<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'hotels',
        'weather',
        'covid'
    ];

    /*protected $casts = [
        'hotels'  => 'json',
        'weather' => 'json',
        'covid'   => 'json'
    ];*/

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
