<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Care extends Model
{
    public $table = 'care';
    public $timestamps = false;
    public $primaryKey = 'careId';
}
