<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'product';
    public $timestamps = false;
    public $primaryKey = 'productId';
}
