<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $table = 'offer';
    public $timestamps = false;
    public $primaryKey = 'offerId';


    public function product(){
        return $this->belongsTo(Product::class,'fkproductId','productId');
    }
}
