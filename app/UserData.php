<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table ='user_data';
    protected $primaryKey = 'dataId';
    protected $fillable = ['uid','catName'];
}
