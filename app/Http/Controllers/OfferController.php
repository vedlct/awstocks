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

use Response;

use DB;
use Excel;


class OfferController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(){

//        $categories=Category::get();
        $categories=Category::select('categoryId','categoryName')->orderBy('categoryName','ASC')->get();
        return view('offer.add')
            ->with('categories',$categories);

    }

    public function edit($id){
        $offer=Offer::findOrFail($id);

//        $offer = Offer::select('offerId','fkproductId','disPrice','disStartPrice','disEndPrice','sku','state','price','stockQty','product-id-type','category.categoryName','product.fkcategoryId','productId')
//            ->leftJoin('product', 'offer.fkproductId', '=', 'product.productId')
//            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
//        ->get();
//        $categories=Category::get();
        $categories=Category::select('categoryId','categoryName')->orderBy('categoryName','ASC')->get();

        return view('offer.edit')
            ->with('offer',$offer)
            ->with('categories',$categories)
            ->with('id',$id);
    }

    public function insert(Request $r){

        $this->validate($r,[
            'product' => 'required|max:70',
            'category' => 'required',
            'disPrice' => 'required',
            'price' => 'required',
            'productIdType'=>'required',
            'disStartPrice'=>'required|date',
            'disEndPrice'=>'required|date|after:disStartPrice',
            'state'=>'required',
            'status'=>'required|max:20',

        ]);


        $offer=array(
            'fkproductId'=>$r->product,
            'disPrice'=>$r->disPrice,
            'disStartPrice'=>$r->disStartPrice,
            'disEndPrice'=>$r->disEndPrice,
            'state'=>$r->state,
            'status'=>$r->status,
//            'lastExportedBy'=>Auth::user()->userId,
            'product-id-type'=>$r->productIdType,

        );
        DB::table('offer')->insert($offer);

        Session::flash('message', 'Offer Added successfully');
        return back();
    }


    public function update(Request $r){

        $this->validate($r,[
            'product' => 'required|max:70',
            'category' => 'required',
            'disPrice' => 'required',
            'price' => 'required',
            'productIdType'=>'required',
            'disStartPrice'=>'required|date',
            'disEndPrice'=>'required|date|after:disStartPrice',
            'state'=>'required',
            'status'=>'required|max:20',

        ]);

        $offer=array(
            'fkproductId'=>$r->product,
            'disPrice'=>$r->disPrice,
            'disStartPrice'=>date("Y-m-d", strtotime($r->disStartPrice)),
            'disEndPrice'=>date("Y-m-d", strtotime($r->disEndPrice)),
            'state'=>$r->state,
            'status'=>$r->status,

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

        $offersql = Offer::select('offerId','disPrice','disStartPrice','disEndPrice','sku','state','price','stockQty','product-id-type','category.categoryName')
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
        $offerList = $offersql->orderBy('offerId',"desc")->get();
        $datatables = Datatables::of($offerList);
        return $datatables->make(true);


    }



    public function editoffer (Request $r) {

        $offerid = $r->id;
        return $offerid;
    }


    public function destroy($id){
        $offer=Offer::findOrfail($id);
        $offer->delete();


        Session::flash('message', 'Offer Deleted successfully');
        return back();

    }

    public function csvExport(Request $r){

        $headers =[
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'application/csv',
            'Content-Disposition' => 'attachment; filename=OfferCreationFull.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $data=array(
            'LastExportedBy'=> Auth::user()->userId,
            'LastExportedDate'=>date('Y-m-d H:i:s'),
            'status'=>Status[1],
        );


        $list=array();
        if ($offerList=$r->fulloffers){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','price','stockQty','state','product-id-type','sku as product-Id')
                    ->leftJoin('product', 'offer.fkproductId', '=', 'product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);

                DB::table('offer')
                    ->where('offerId',$productId)
                    ->update($data);
            }

        }
        if ($offerList=$r->priceCreation){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','price')
                    ->leftJoin('product', 'offer.fkproductId', '=','product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);

                DB::table('offer')
                    ->where('offerId',$productId)
                    ->update($data);
            }

        }

        if ($offerList=$r->stockUpdate){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','stockQty')
                    ->leftJoin('product', 'offer.fkproductId', '=','product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);

                DB::table('offer')
                    ->where('offerId',$productId)
                    ->update($data);
            }

        }
        if ($offerList=$r->markdownUpdate){

            for ($i=0;$i<count($offerList);$i++){
                $productId=$offerList[$i];
                $newlist=Offer::select('sku','disPrice','disStartPrice','disEndPrice')
                    ->leftJoin('product', 'offer.fkproductId', '=','product.productId')
                    ->where('offer.offerId',$productId)->get()->toArray();

                $list=array_merge($list,$newlist);

                DB::table('offer')
                    ->where('offerId',$productId)
                    ->update($data);
            }

        }
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));



        if ($offerList=$r->fulloffers){
//            $fileName="FullOfferList-".date_timestamp_get(now());
            $fileName="FullOfferList";

        }
        if ($offerList=$r->priceCreation){
            $fileName="PriceUpdateList-".date_timestamp_get(now());
            $fileName="PriceUpdateList";

        }
        if ($offerList=$r->stockUpdate){
//            $fileName="StockUpdateList-".date_timestamp_get(now());
            $fileName="StockUpdateList";

        }
        if ($offerList=$r->markdownUpdate){
//            $fileName="markdownUpdateList-".date_timestamp_get(now());
            $fileName="markdownUpdateList";

        }

        $callback = function() use ($list,$r,$fileName)
        {

            if ($offerList=$r->fulloffers){
                //$fileName="FullOfferList-".date_timestamp_get(now());
                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
            }
            if ($offerList=$r->priceCreation){
               // $fileName="PriceUpdateList-".date_timestamp_get(now());
                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
            }
            if ($offerList=$r->stockUpdate){
               // $fileName="StockUpdateList-".date_timestamp_get(now());
                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
            }
            if ($offerList=$r->markdownUpdate){
                //$fileName="markdownUpdateList-".date_timestamp_get(now());
                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
            }

            foreach ($list as $row) {
                fputcsv($FH, $row);

            }

            fclose($FH);
        };
//
         return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;






    }


}
