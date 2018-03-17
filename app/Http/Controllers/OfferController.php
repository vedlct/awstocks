<?php

namespace App\Http\Controllers;

use App\Season;
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


use Symfony\Component\HttpFoundation\StreamedResponse;


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



       // $filePath=public_path ()."/csv"."/".$fileName;



        if ($offerList=$r->fulloffers){
            $fileName="FullOfferList-".date_timestamp_get(now()).".csv";
            $filePath=public_path ()."/csv"."/".$fileName;
           // $fileName="FullOfferList";

            $fileInfo=array('fileName'=>$fileName);

        }
        if ($offerList=$r->priceCreation){
            $fileName="PriceUpdateList-".date_timestamp_get(now()).".csv";
           // $fileName="PriceUpdateList";
            $fileInfo=array('fileName'=>$fileName);
            $filePath=public_path ()."/csv"."/".$fileName;

        }
        if ($offerList=$r->stockUpdate){
            $fileName="StockUpdateList-".date_timestamp_get(now()).".csv";
//            $fileName="StockUpdateList";
            $fileInfo=array('fileName'=>$fileName);
            $filePath=public_path ()."/csv"."/".$fileName;
        }
        if ($offerList=$r->markdownUpdate){
            $fileName="markdownUpdateList-".date_timestamp_get(now()).".csv";
//            $fileName="markdownUpdateList";
            $fileInfo=array('fileName'=>$fileName);
            $filePath=public_path ()."/csv"."/".$fileName;
        }

//        $callback = function() use ($list,$r,$fileName)
//        {
//
//            if ($offerList=$r->fulloffers){
//                //$fileName="FullOfferList-".date_timestamp_get(now());
//                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
//            }
//            if ($offerList=$r->priceCreation){
//               // $fileName="PriceUpdateList-".date_timestamp_get(now());
//                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
//            }
//            if ($offerList=$r->stockUpdate){
//               // $fileName="StockUpdateList-".date_timestamp_get(now());
//                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
//            }
//            if ($offerList=$r->markdownUpdate){
//                //$fileName="markdownUpdateList-".date_timestamp_get(now());
//                $FH = fopen(public_path ()."/csv/".$fileName.".csv", "w");
//            }
//
//            foreach ($list as $row) {
//                fputcsv($FH, $row);
//
//            }
//
//            fclose($FH);
//        };
////
//         return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;

        $response = new StreamedResponse();

        $response->setCallback(function () use ($list,$r,$filePath){

            if ($offerList=$r->fulloffers){
                //$fileName="FullOfferList-".date_timestamp_get(now());
                $FH = fopen($filePath, "w");
            }
            if ($offerList=$r->priceCreation){
                // $fileName="PriceUpdateList-".date_timestamp_get(now());
                $FH = fopen($filePath, "w");
            }
            if ($offerList=$r->stockUpdate){
                // $fileName="StockUpdateList-".date_timestamp_get(now());
                $FH = fopen($filePath, "w");
            }
            if ($offerList=$r->markdownUpdate){
                //$fileName="markdownUpdateList-".date_timestamp_get(now());
                $FH = fopen($filePath, "w");
            }

            $FH = fopen($filePath, "w");
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        });

        $response->send();

//        $data1=array(
//            'historicUploadedFilesName'=>$fileName,
//            'historicUploadedFilesType'=>"OfferList",
//            'createdBy'=>Auth::user()->userId,
//
//        );
//
//        DB::table('historicuploadedfiles')
//            ->insert($data1);

        $fileInfo=array(
            'fileName'=>$fileName,
            'filePath'=>$filePath,
        );

        return $fileInfo;






    }

    public function BulkOffer() {

        $categories=Category::get();
        $season = Season::get();
//        $productsList=Product::select('productId','productName')
//            ->get();
        return view('offer.bulkoffer')
            ->with('categories',$categories)
            ->with('season',$season);
//            ->with('productsList',$productsList);


    }
    public function BulkOfferdt(Request $r) {
        $list=Product::select('productId','style','sku','brand','product.status','productName','users.name as userName','LastExportedDate','category.categoryName')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
            ->leftJoin('users', 'users.userId', '=', 'product.LastExportedBy')
            ->where ('product.status', Status[1]);

        if ($status=$r->status){
            $list->where('product.status',$status);
        }
        if ($categoryId=$r->categoryId){
            $list->where('product.fkcategoryId',$categoryId);
        }
        if ($productName=$r->productName){
            $list->where('product.productName',$productName);
        }


//        $productList = $list->get();
        $productList = $list->orderBy('productId',"desc")->get();

        $datatables = Datatables::of($productList);

        return $datatables->make(true);
    }


}
