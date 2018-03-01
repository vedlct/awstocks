<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    //
    //this is ajax controller which return all offerlist
    public function getOfferList() {

        return Datatables::of(Product::select('offerId','disPrice','disStartPrice','disEndPrice','state','price','quantity','productId','product-id-type','category.name as categoryName')
            ->leftJoin('product', 'offer.fkproductId', '=', 'product.productId')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
            ->get())->make(true);

    }
}
