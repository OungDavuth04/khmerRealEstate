<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeaturAd extends Model
{
    protected $primaryKey='promoteId';
    protected $table = 'userspromote';
    protected $fillable = [
        'UpId', 'price', 'day','uid','expire'
    ];
}
