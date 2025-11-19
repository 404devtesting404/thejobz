<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldOverallRate extends Model
{
    use HasFactory;

    protected $table = 'gold_overall_rates';

    protected $fillable = [
        'tola1_24k',
        'gram10_24k',
        'gram1_24k',
    ];
}
