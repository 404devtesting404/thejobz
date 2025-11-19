<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldRate extends Model
{
    use HasFactory;

    protected $fillable = ['city', 'symbol', 'bidding', 'asking'];
}
