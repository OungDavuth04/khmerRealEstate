<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataUpload extends Model
{
    protected $table ='users_upload';
    protected $fillable = [
        'uid','title', 'bedroom','bathroom','facing','size','price','description','glat',
        'glng','localdetail','email','phone','province','district','commune'
    ];
}
