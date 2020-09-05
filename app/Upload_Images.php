<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload_Images extends Model
{
    protected $table ='images';
    protected $fillable = [
        'UpId', 'image'
    ];
}
