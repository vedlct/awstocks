<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public $table = 'size';
    public $timestamps = false;
    public $primaryKey = 'sizeId';
}
