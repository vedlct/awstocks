<?php
namespace App\Http\Controllers;
use App\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use Input;
use Exception;
use Session;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Category;
use App\Color;
use App\Size;
use App\RunToSize;
use App\Care;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use Symfony\Component\HttpFoundation\StreamedResponse;

use Excel;
use PHPExcel_Worksheet_Drawing;

use Illuminate\Support\Facades\URL;




//use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(){
        $categories=Category::select('categoryId','categoryName')->orderBy('categoryName','ASC')->get();
        $sColors=Color::select('colorId','colorName')->orderBy('colorName','ASC')->get();
        $sizeTypes=Size::select('sizeId','sizeName','sizeType')->orderBy('sizeType','ASC')->groupBy('sizeType')->get();
        $runToSizes=RunToSize::select('runToSizeId','runToSizeName')->orderBy('runToSizeName','ASC')->get();
        $cares=Care::select('careId','careName')->orderBy('careName','ASC')->get();

        return view('product.add')
            ->with('categories',$categories)
            ->with('sColors',$sColors)
            ->with('runToSizes',$runToSizes)
            ->with('cares',$cares)
            ->with('sizeTypes',$sizeTypes);
    }


    public function getSizeByType(Request $r){
        $size=Size::where('sizeType',$r->type)->get();

        if($size==null){
            echo "<option value=''>select one</option>";
        }
        else {
            foreach ($size as $s) {
                echo "<option value='$s->sizeName'>$s->sizeName</option>";
            }
        }

        //return Response($size);
    }

    public function getProductByCategory(Request $r){
        $product=Product::select('productId','productName')->where('fkcategoryId',$r->category)->where('status',Status[1])->get();
            echo "<option value=''>select one</option>";
            foreach ($product as $p) {
                echo "<option value='$p->productId'>$p->productName</option>";
            }

//        return Response($product);
     }

    public function edit($id){


        $categories=Category::select('categoryId','categoryName')->orderBy('categoryName','ASC')->get();
        $sColors=Color::select('colorId','colorName')->orderBy('colorName','ASC')->get();
        $sizeTypes=Size::select('sizeId','sizeName','sizeType')->orderBy('sizeType','ASC')->groupBy('sizeType')->get();
        $runToSizes=RunToSize::select('runToSizeId','runToSizeName')->orderBy('runToSizeName','ASC')->get();
        $cares=Care::select('careId','careName')->orderBy('careName','ASC')->get();


        $product=Product::findOrFail($id);

        $sizeTypess=Size::select('sizeType')->where('sizeName',$product->size)->first();
        if($sizeTypess ==null){
            $sizeTypess="none";
        }
        else{
            $sizeTypess=$sizeTypess->sizeType;
        }



//        $type=Size::where('sizeType',$product->)->get();

        //return $sizeTypess;

        return view('product.edit')
            ->with('categories',$categories)
            ->with('sColors',$sColors)
            ->with('product',$product)
            ->with('sizeTypes',$sizeTypes)
            ->with('cares',$cares)
            ->with('runToSizes',$runToSizes)
            ->with('id',$id)
            ->with('sizeTypess',$sizeTypess);
    }

    public function insert(Request $r){

        $rules=[
            'productName' => 'required|max:70',
            'status' => 'required|max:50',
            'description' => 'required|max:1100',
            'style' => 'required|max:15',
            'sku'=>'required|max:20',
            'brand'=>'required|max:100',
            'size'=>'max:255',
            'sizeDescription'=>'max:255',
            'runToSize'=>'max:255',
            'color'=>'required|max:45',
            'colorDesc'=>'required|max:20',
            'ean'=>'max:13',
            'care'=>'max:255',
            'swatchPic'=>'image|mimes:jpeg,jpg',
            'outfitPic'=>'image|mimes:jpeg,jpg',
            'mainPic' =>'required|image|mimes:jpeg,jpg',
            'image2Pic'=>'image|mimes:jpeg,jpg',
            'image3Pic'=>'image|mimes:jpeg,jpg',
            'image4Pic'=>'image|mimes:jpeg,jpg',
            'location'=>'max:100'
        ];

        $messages = [
            // 'dimensions' => 'Image dimention should be over 800px',
        ];

        $validator = Validator::make($r->all(), $rules,$messages)->validate();

        $product=new Product();
        $product->productName=$r->productName;
        $product->status=$r->status;
        $product->productDesc=$r->description;
        $product->style=$r->style;
        $product->sku=$r->sku;
        $product->brand=$r->brand;
        $product->size=$r->size;
        $product->sizeDescription=$r->sizeDescription;
        $product->fkcategoryId=$r->category;
        $product->ean=$r->ean;
        $product->color=$r->color;
        $product->colorDesc=$r->colorDesc;
        $product->care=$r->care;
        $product->price=$r->price;
        $product->costPrice=$r->costPrice;
        $product->wholePrice=$r->wholePrice;
        $product->stockQty=$r->stockQty;
        $product->minQtyAlert=$r->minQtyAlert;
        $product->runtosize=$r->runToSize;
        $product->location=$r->location;
        $product->created_at=date(now());
        //$product->LastExportedBy=Auth::user()->userId;
        $product->save();

        if($r->hasFile('swatchPic')){
            $img = $r->file('swatchPic');
            $filename= $product->productId.'swatch'.'.'.$img->getClientOriginalExtension();
            $product->swatchImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('outfitPic')){
            $img = $r->file('outfitPic');
            $filename= $product->productId.'outfit'.'.'.$img->getClientOriginalExtension();
            $product->outfit=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('mainPic')){
            $img = $r->file('mainPic');
            $filename= $product->productId.'main'.'.'.$img->getClientOriginalExtension();
            $product->mainImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);

        }
        if($r->hasFile('image2Pic')){
            $img = $r->file('image2Pic');
            $filename= $product->productId.'image2'.'.'.$img->getClientOriginalExtension();
            $product->image2=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('image3Pic')){
            $img = $r->file('image3Pic');
            $filename= $product->productId.'image3'.'.'.$img->getClientOriginalExtension();
            $product->image3=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('image4Pic')){
            $img = $r->file('image4Pic');
            $filename= $product->productId.'image4'.'.'.$img->getClientOriginalExtension();
            $product->image4=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        $product->save();
        Session::flash('message', 'Product Uploaded successfully');
        return back();
    }


    public function update(Request $r){

        $rules=[
            'productName' => 'required|max:70',
            'status' => 'required|max:50',
            'description' => 'required|max:1100',
            'style' => 'required|max:15',
            'sku'=>'required|max:20',
            'brand'=>'required|max:100',
            'size'=>'max:255',
            'sizeDescription'=>'max:255',
            'runToSize'=>'max:255',
            'color'=>'required|max:45',
            'colorDesc'=>'required|max:20',
            'ean'=>'max:13',
            'care'=>'max:255',
            'swatchPic'=>'image|mimes:jpeg,jpg',
            'outfitPic'=>'image|mimes:jpeg,jpg',
            'mainPic' =>'image|mimes:jpeg,jpg',
            'image2Pic'=>'image|mimes:jpeg,jpg',
            'image3Pic'=>'image|mimes:jpeg,jpg',
            'image4Pic'=>'image|mimes:jpeg,jpg',
            'location'=>'max:100'
        ];

        $messages = [
           // 'dimensions' => 'Image dimention should over 800px',
        ];
        $validator = Validator::make($r->all(), $rules,$messages)->validate();


        $product=Product::findOrFail($r->id);
        $product->productName=$r->productName;
        $product->status=$r->status;
        $product->productDesc=$r->description;
        $product->style=$r->style;
        $product->sku=$r->sku;
        $product->brand=$r->brand;
        $product->size=$r->size;
        $product->sizeDescription=$r->sizeDescription;
        $product->fkcategoryId=$r->category;
        $product->ean=$r->ean;
        $product->color=$r->color;
        $product->colorDesc=$r->colorDesc;
        $product->care=$r->care;

        $product->price=$r->price;
        $product->costPrice=$r->costPrice;
        $product->wholePrice=$r->wholePrice;

        $product->stockQty=$r->stockQty;
        $product->minQtyAlert=$r->minQtyAlert;
        $product->runtosize=$r->runToSize;
        $product->location=$r->location;
//        $product->LastExportedBy=Auth::user()->userId;
//        $product->save();

        if($r->hasFile('swatchPic')){
            $img = $r->file('swatchPic');
            $filename= $product->productId.'swatch'.'.'.$img->getClientOriginalExtension();
            $product->swatchImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('outfitPic')){
            $img = $r->file('outfitPic');
            $filename= $product->productId.'outfit'.'.'.$img->getClientOriginalExtension();
            $product->outfit=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('mainPic')){
            $img = $r->file('mainPic');
            $filename= $product->productId.'main'.'.'.$img->getClientOriginalExtension();
            $product->mainImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('image2Pic')){
            $img = $r->file('image2Pic');
            $filename= $product->productId.'image2'.'.'.$img->getClientOriginalExtension();
            $product->image2=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('image3Pic')){
            $img = $r->file('image3Pic');
            $filename= $product->productId.'image3'.'.'.$img->getClientOriginalExtension();
            $product->image3=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        if($r->hasFile('image4Pic')){
            $img = $r->file('image4Pic');
            $filename= $product->productId.'image4'.'.'.$img->getClientOriginalExtension();
            $product->image4=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->save($location);
            $location2 = public_path('productImage/thumb/'.$filename);
            Image::make($img)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($location2);
        }
        $product->save();
        Session::flash('message', 'Product Updated  successfully');
        return back();
    }

    public function getProductPrice(Request $r){

        $price=Product::findOrFail($r->id);

         return Response($price);
    }

    public function allProduct(){
        $categories=Category::get();
//        $productsList=Product::select('productId','productName')
//            ->get();
        return view('product.allproductList')
            ->with('categories',$categories);
//            ->with('productsList',$productsList);

    }
    /* for datatable in all product page */
    public function ProductList(Request $r)
    {
        $list=Product::select('productId','style','sku','brand','product.status','productName','users.name as userName','LastExportedDate','category.categoryName')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
            ->leftJoin('users', 'users.userId', '=', 'product.LastExportedBy');

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

    public function Store($val){
        return $val;
    }

    public function destroy($id){
        $product=Product::findOrFail($id);
        $offer = Offer::select('offerId')
            ->where('fkproductId', $id)
            ->get();

//        return $offer;
        if (!$offer->isEmpty()){
            Session::flash('danger', 'This product is linked with an Offer, Please delete that offer record first from the Offer list. After that you will be able to delete this Product.');
            return back();
        }
        if($product->swatch!=null){
            File::delete('productImage/'.$product->swatch);
        }
        if($product->outfit!=null){
            File::delete('productImage/'.$product->outfit);
        }
        if($product->image2!=null){
            File::delete('productImage/'.$product->image2);
        }

        if($product->image3!=null){
            File::delete('productImage/'.$product->image3);
        }


        if($product->image4!=null){
            File::delete('productImage/'.$product->image4);
        }


        if($product->mainImage!=null){
            File::delete('productImage/'.$product->mainImage);
        }

        $product->delete();
        Session::flash('message', 'Product Deleted successfully');
        return back();
    }
    public function csvExport(Request $r){

        $headers =[
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'application/csv',
            'Content-Disposition' => 'attachment; filename=ProductList.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $productList=$r->products;
        $data=array(
            'LastExportedBy'=>Auth::user()->userId,
            'LastExportedDate'=>date('Y-m-d H:i:s'),
            'status'=>Status[1],
        );

        $list=array();
//        $OfferList=array();
        for ($i=0;$i<count($productList);$i++){
            $productId=$productList[$i];
            $newlist=Product::select('product.price','product.stockQty','product.sku as product-Id','product.minQtyAlert','category.categoryName','style','sku','productName','productDesc','brand','color','colorDesc','swatchImage','size','mainImage','outfit','image2')
                ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')->where('product.productId',$productId)->get()->toArray();
            $list=array_merge($list,$newlist);


//            $newOfferList=Product::select('product.sku','product.price','product.stockQty','product.sku as product-Id','product.minQtyAlert')
//
//                ->where('product.productId',$productId)->get()->toArray();
//            $OfferList=array_merge($OfferList,$newOfferList);



            DB::table('product')
                ->where('productId',$productId)
                ->update($data);
        }



//        $fileName="ProductList-".date_timestamp_get(now()).".csv";
//        $filePath=public_path ()."/csv"."/".$fileName;
//
//        $fileInfo=array(
//            'fileName'=>$fileName,
//            'filePath'=>$filePath,
//            'alllist'=>$list
//        );


       // $filePath=public_path ()."/csv/ProductList.csv";

        # add headers for each column in the CSV download

       // array_unshift($list, array_keys($list[0]));
        
       // return $r;

//        $callback = function() use ($list,$filePath)
//        {
//            $FH = fopen($filePath, "w");
//
//            foreach ($list as $row) {
//                fputcsv($FH, $row);
//            }
//            fclose($FH);
//        };


//        $data1=array(
//            'historicUploadedFilesName'=>$fileName,
//            'historicUploadedFilesType'=>"ProductList",
//            'createdBy'=>Auth::user()->userId,
//
//        );
//
//        DB::table('historicuploadedfiles')
//            ->insert($data1);


//         return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;


//        $response = new StreamedResponse();
//
//        $response->setCallback(function () use ($list,$filePath){
//
//            $FH = fopen($filePath, "w");
//            foreach ($list as $row) {
//                fputcsv($FH, $row);
//            }
//            fclose($FH);
//        });
//
//        $response->send();
//        return $list;

        $filePath=public_path ()."/csv";
//        $fileName="ProductList-".date_timestamp_get(now());
        $fileName="ProductList-".date("Y-m-d_H-i-s");
        $fileInfo=array(
            'fileName'=>$fileName,
            'filePath'=>$filePath,
        );

        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF'];

        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
        $pathInfo = pathinfo($currentPath);

        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];

        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

        // return: http://localhost/myproject/
        $url= $protocol.'://'.$hostName.$pathInfo['dirname']."/";



        $check=Excel::create($fileName,function($excel) use($list,$filePath,$url) {
            $excel->sheet('First sheet', function($sheet) use($list,$url) {
                $sheet->loadView('product.serverCSVProductList')
                    ->with('productList',$list)
                    ->with('url',$url);
            });

        })->store('csv',$filePath);
        if ($check) {

            $forftp=Excel::create("ProductList",function($excel) use($list,$filePath,$url) {
                $excel->sheet('First sheet', function($sheet) use($list,$url) {
                    $sheet->loadView('product.serverCSVProductList')
                        ->with('productList',$list)
                        ->with('url',$url);
                });

            })->store('csv',$filePath);

            $forftp=Excel::create("OfferList",function($excel) use($list,$filePath,$url) {
                $excel->sheet('First sheet', function($sheet) use($list,$url) {
                    $sheet->loadView('offer.serverCSVPriceAndQuantityForProductList')
                        ->with('productList',$list)
                        ->with('url',$url);
                });

            })->store('csv',$filePath);

            Session::flash('message', $fileName . '.csv and ProductList.csv,OfferList.csv has been sent to server');
        }else{
            Session::flash('message',' Someting went wrong');
        }
        return $fileInfo;




    }

    public function sendftp(Request $r)
    {

        $ftp_server = "ftp.sakibrahman.com";
        $ftp_username = "baker@sakibrahman.com";
            $ftp_userpass = "baker@123";
        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
        $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

        $a=array();
        foreach ($r->products as $prod) {

            // upload file
            
            try{
                ftp_put($ftp_conn, $prod, $r->path.$prod, FTP_ASCII);
            }
            catch (Exception $e){
                array_push($a,"File Not Found ".$prod);

            }
//        }


        }


// close connection
        ftp_close($ftp_conn);

        return $a;

    }

    public function excelExport(Request $r)
    {
        $productList=$r->products;
        $filePath=public_path ()."/excel";
        $fileName="productList".date("Y-m-d_H-i-s");
        $fileInfo=array(
            'fileName'=>$fileName,
            'filePath'=>$fileName,
        );

        $list=array();
        for ($i=0;$i<count($productList);$i++){
            $productId=$productList[$i];
            $newlist=Product::select('category.categoryName','style','sku','ean','productName','productDesc','brand','color','colorDesc','size',
                'sizeDescription','mainImage','swatchImage','outfit','image2','image3','image4','runtosize','care','price','costPrice','location',
                'wholePrice','stockQty','minQtyAlert','LastExportedBy','LastExportedDate')
                ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')->where('product.productId',$productId)->get()->toArray();
            $list=array_merge($list,$newlist);

        }
        Excel::create($fileName,function($excel) use($list,$filePath) {
            $excel->sheet('First sheet', function($sheet) use($list) {
                $sheet->loadView('product.localDownloadProductList')->with('productList',$list);
            });

        })->store('xls',$filePath);

        return $fileInfo;

    }



}