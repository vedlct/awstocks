<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Session;
use App\Offer;
use App\Product;
use App\Category;
use DB;

class OfferController extends Controller
{
    //

    public function add(){

        $categories=Category::get();

        return view('offer.add')
            ->with('categories',$categories);

    }



    public function edit($id){
        $offer=Offer::findOrFail($id);
        $categories=Category::get();

        return view('offer.edit')
            ->with('offer',$offer)
            ->with('categories',$categories)
            ->with('id',$id);
    }

    public function insert(Request $r){


        $offer=array(
            'fkproductId'=>$r->product,
            'disPrice'=>$r->disPrice,
            'disStartPrice'=>$r->disStartPrice,
            'disEndPrice'=>$r->disEndPrice,
            'state'=>$r->state,
            'status'=>$r->status,
            'lastExportedBy'=>Auth::user()->userId,
            'product-id-type'=>$r->productIdType,

        );
        DB::table('offer')->insert($offer);

        Session::flash('message', 'Offer Added successfully');
        return back();
    }


    public function update(Request $r){
        $offer=array(
            'fkproductId'=>$r->product,
            'disPrice'=>$r->disPrice,
            'disStartPrice'=>$r->disStartPrice,
            'disEndPrice'=>$r->disEndPrice,
            'state'=>$r->state,
            'status'=>$r->status,
            'lastExportedBy'=>Auth::user()->userId,
            'product-id-type'=>$r->productIdType,

        );
        DB::table('offer')
            ->where('offerId',$r->id)
            ->update($offer);

        Session::flash('message', 'Offer Updated successfully');
        return back();


    }

    public function index(){
        $catagory = Category::get();
        $product = Product::select('status')
            ->groupBy('status')
            ->get();
        $offerstatus = Offer::select('status')
            ->groupBy('status')
            ->get();
        return view('offer.generate')
            ->with('categories', $catagory)
            ->with('productStatus', $product)
        ->with('offerStatus', $offerstatus);
    }
    //this is ajax controller which return all offerlist
    public function getOfferList(Request $r) {

        $offersql = Offer::select('offerId','disPrice','disStartPrice','disEndPrice','sku','state','price','quantity','productId','product-id-type','categoryName')
            ->leftJoin('product', 'offer.fkproductId', '=', 'product.productId')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId');
        if ($categoryId=$r->categoryId){
            $offersql->where('product.fkcategoryId',$categoryId);
        }
        if ($productstatus=$r->productstatus){
            $offersql->where('product.status',$productstatus);
        }
        if ($offerstatus=$r->offer){
            $offersql->where('offer.status',$offerstatus);
        }
        $offerList = $offersql->get();
        $datatables = Datatables::of($offerList);
        return $datatables->make(true);


    }



    public function editoffer (Request $r) {

        $offerid = $r->id;
        return $offerid;
    }

    public function test(){}

}
