<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Session;
use App\Offer;
use App\Product;
use App\Category;
use Response;
class OfferController extends Controller
{
    //

    public function index(){
        $catagory = Category::get();
//        $product = Product::select('status')
//            ->groupBy('status')
//            ->get();
//        $offerstatus = Offer::select('status')
//            ->groupBy('status')
//            ->get();
        return view('offer.generate')
            ->with('categories', $catagory);
    }
    //this is ajax controller which return all offerlist
    public function getOfferList(Request $r) {

        $offersql = Offer::select('offerId','disPrice','disStartPrice','disEndPrice','sku','state','price','stockQty','product-id-type')
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

    public function csvExport(Request $r){

        $headers =[
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'application/csv',
            'Content-Disposition' => 'attachment; filename=OfferCreationFull.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];
        $list=array();

        if ($offerList=$r->fulloffers){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','price','stockQty','state','product-id-type','sku as product-Id')
                    ->leftJoin('product', 'offer.fkproductId', '=', 'product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);
            }

        }
        if ($offerList=$r->priceCreation){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','price')
                    ->leftJoin('product', 'offer.fkproductId', '=','product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);
            }

        }

        if ($offerList=$r->stockUpdate){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','stockQty')
                    ->leftJoin('product', 'offer.fkproductId', '=','product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);
            }

        }
        if ($offerList=$r->markdownUpdate){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','disPrice','disStartPrice','disEndPrice')
                    ->leftJoin('product', 'offer.fkproductId', '=','product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);
            }

        }





        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));



        $callback = function() use ($list,$r)
        {

            if ($offerList=$r->fulloffers){
                $FH = fopen(public_path ()."/csv/FullOfferList.csv", "w");
            }
            if ($offerList=$r->priceCreation){
                $FH = fopen(public_path ()."/csv/PriceUpdateList.csv", "w");
            }
            if ($offerList=$r->stockUpdate){
                $FH = fopen(public_path ()."/csv/StockUpdateList.csv", "w");
            }
            if ($offerList=$r->markdownUpdate){
                $FH = fopen(public_path ()."/csv/markdownUpdateList.csv", "w");
            }



            foreach ($list as $row) {
                fputcsv($FH, $row);
            }

            fclose($FH);
        };

        return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;



    }


}
