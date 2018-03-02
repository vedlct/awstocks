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

    public function index(){
        $catagory = Category::get();
        return view('offer.generate')
            ->with('category', $catagory);
    }
    //this is ajax controller which return all offerlist
    public function getOfferList() {

        return Datatables::of(Offer::select('offerId','disPrice','disStartPrice','disEndPrice','sku','state','price','quantity','productId','product-id-type','category.name as categoryName')
            ->leftJoin('product', 'offer.fkproductId', '=', 'product.productId')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
            ->get())
            ->make(true);

    }

    public function editoffer (Request $r) {

        $offerid = $r->id;
        return $offerid;
    }

    public function test(){}

}
