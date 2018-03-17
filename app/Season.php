<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public $table = 'season';
    public $timestamps = false;
    public $primaryKey = 'seasonId';
}
