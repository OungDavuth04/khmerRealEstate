<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table ='user_uplaod';
    protected $primaryKey ='UpId';
    protected $fillable = [
        'uid','title', 'bedroom','bathroom','facing','size','price','description','map_lat',
        'map_lng','localdetail','email','phone','province','district','commune','cat_name'
    ];

}
