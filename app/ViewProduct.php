<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewProduct extends Model
{
    protected $table = 'view_products';
    protected $primaryKey = 'Vid';
    protected $fillable = ['UpId','viewer'];
}
