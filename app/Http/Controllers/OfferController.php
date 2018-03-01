<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Session;
use App\Offer;
use App\Product;
use App\Category;

class OfferController extends Controller
{
    //
    //this is ajax controller which return all offerlist
    public function getOfferList() {

        return Datatables::of(Offer::select('offerId','disPrice','disStartPrice','disEndPrice','sku','state','price','quantity','productId','product-id-type','category.name as categoryName')
            ->leftJoin('product', 'offer.fkproductId', '=', 'product.productId')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
            ->get())
            ->make(true);

    }
}
