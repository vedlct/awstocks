<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use Session;
use App\Product;
use App\Category;
use App\Color;
use App\Size;
use App\RunToSize;
use App\Care;
use Yajra\DataTables\DataTables;
use Response;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add(){
        $categories=Category::get();
        $sColors=Color::where('colorType','standard')
            ->get();


        $sizeTypes=Size::groupBy('sizeType')
            ->get();
        $runToSizes=RunToSize::get();
        $cares=Care::get();

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

    public function edit($id){
        $categories=Category::get();
        $sColors=Color::where('colorType','standard')
            ->get();
        $sizeTypes=Size::groupBy('sizeType')
            ->get();
        $runToSizes=RunToSize::get();
        $cares=Care::get();
        $product=Product::findOrFail($id);
        return view('product.edit')
            ->with('categories',$categories)
            ->with('sColors',$sColors)
            ->with('product',$product)
            ->with('sizeTypes',$sizeTypes)
            ->with('cares',$cares)
            ->with('runToSizes',$runToSizes)
            ->with('id',$id);
    }


    public function update(Request $r){
        $this->validate($r,[
            'productName' => 'required|max:70',
            'status' => 'max:8',
            'description' => 'required|max:1100',
            'style' => 'required|max:15',
            'sku'=>'max:20',
            'brand'=>'max:45',
            'size'=>'required',
            'color'=>'required',
            'colorDesc'=>'max:20',
            'ean'=>'max:13',
            'care'=>'required',
        ]);


        $product=Product::findOrFail($r->id);
        $product->productName=$r->productName;
        $product->status=$r->status;
        $product->productDesc=$r->description;
        $product->style=$r->style;
        $product->sku=$r->sku;
        $product->brand=$r->brand;
        $product->size=$r->size;
        $product->fkcategoryId=$r->category;
        $product->ean=$r->ean;
        $product->color=$r->color;
        $product->colorDesc=$r->colorDesc;
        $product->care=$r->care;
        $product->price=$r->price;
        $product->stockQty=$r->stockQty;
        $product->minQtyAlert=$r->minQtyAlert;
        $product->runtosize=$r->runToSize;
//        $product->LastExportedBy=Auth::user()->userId;
//        $product->save();
        if($r->hasFile('swatchPic')){
            $img = $r->file('swatchPic');
            $filename= $product->productId.'swatch'.'.'.$img->getClientOriginalExtension();
            $product->swatch=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('outfitPic')){
            $img = $r->file('outfitPic');
            $filename= $product->productId.'outfit'.'.'.$img->getClientOriginalExtension();
            $product->outfit=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('mainPic')){
            $img = $r->file('mainPic');
            $filename= $product->productId.'main'.'.'.$img->getClientOriginalExtension();
            $product->mainImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('image2Pic')){
            $img = $r->file('image2Pic');
            $filename= $product->productId.'image2'.'.'.$img->getClientOriginalExtension();
            $product->image2=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('image3Pic')){
            $img = $r->file('image3Pic');
            $filename= $product->productId.'image3'.'.'.$img->getClientOriginalExtension();
            $product->image3=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('image4Pic')){
            $img = $r->file('image4Pic');
            $filename= $product->productId.'image4'.'.'.$img->getClientOriginalExtension();
            $product->image4=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        $product->save();
        Session::flash('message', 'Product Updated  successfully');
        return back();
    }
//    public function generate(){
//        return view('product.generate');
//    }
    public function allProduct(){
        $categories=Category::get();
        $productsList=Product::select('productId','productName')
            ->get();
        return view('product.allproductList')
            ->with('categories',$categories)
            ->with('productsList',$productsList);
    }
    /* for datatable in all product page */
    public function ProductList(Request $r)
    {
        $list=Product::select('productId','style','sku','brand','status','productName','LastExportedBy','LastExportedDate','category.name as categoryName')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId');
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
        $productList = $list;
        $datatables = Datatables::of($productList);
        return $datatables->make(true);
    }
    public function insert(Request $r){
        /*use Image Plugin from http://image.intervention.io/getting_started/installation
        *
        *
        *
        */

//        return $r;
        $this->validate($r,[
            'productName' => 'required|max:70',
            'status' => 'max:8',
            'description' => 'required|max:1100',
            'style' => 'required|max:15',
            'sku'=>'max:20',
            'brand'=>'max:45',
            'size'=>'required',
            'color'=>'required',
            'colorDesc'=>'max:20',
            'ean'=>'max:13',
            'care'=>'required',
        ]);
        $product=new Product();
        $product->productName=$r->productName;
        $product->status=$r->status;
        $product->productDesc=$r->description;
        $product->style=$r->style;
        $product->sku=$r->sku;
        $product->brand=$r->brand;
        $product->size=$r->size;
        $product->fkcategoryId=$r->category;
        $product->ean=$r->ean;
        $product->color=$r->color;
        $product->colorDesc=$r->colorDesc;
        $product->care=$r->care;
        $product->price=$r->price;
        $product->stockQty=$r->stockQty;
        $product->minQtyAlert=$r->minQtyAlert;
        $product->runtosize=$r->runToSize;
        $product->LastExportedBy=Auth::user()->userId;
        $product->save();

        if($r->hasFile('swatchPic')){
            $img = $r->file('swatchPic');
            $filename= $product->productId.'swatch'.'.'.$img->getClientOriginalExtension();
            $product->swatchImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('outfitPic')){
            $img = $r->file('outfitPic');
            $filename= $product->productId.'outfit'.'.'.$img->getClientOriginalExtension();
            $product->outfit=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('mainPic')){
            $img = $r->file('mainPic');
            $filename= $product->productId.'main'.'.'.$img->getClientOriginalExtension();
            $product->mainImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('image2Pic')){
            $img = $r->file('image2Pic');
            $filename= $product->productId.'image2'.'.'.$img->getClientOriginalExtension();
            $product->image2=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('image3Pic')){
            $img = $r->file('image3Pic');
            $filename= $product->productId.'image3'.'.'.$img->getClientOriginalExtension();
            $product->image3=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('image4Pic')){
            $img = $r->file('image4Pic');
            $filename= $product->productId.'image4'.'.'.$img->getClientOriginalExtension();
            $product->image4=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        $product->save();
        Session::flash('message', 'Product Uploaded successfully');
        return back();
    }
    public function Store($val){
        return $val;
    }
    public function destroy($id){
        $product=Product::findOrFail($id);
        if($product->swatch!=null){
            File::delete('productImage/'.$product->swatch);
        }
        if($product->outfit!=null){
            File::delete('productImage/'.$product->outfit);
        }
        if($product->image2!=null){
            File::delete('productImage/'.$product->image2);
        }
        if($product->mainImage!=null){
            File::delete('productImage/'.$product->mainImage);
        }
        $product->delete();
        Session::flash('message', 'Product Deleted successfully');
        return back();
    }
    public function csvExport(Request $r){

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename=galleries.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];



        $productList=$r->productId;
        $list=array();
        for ($i=0;$i<=count($productList);$i++){
            $productId=$i;
            $newlist=Product::select('productId','style','sku','brand','status','productName','LastExportedBy','LastExportedDate','category.name as categoryName')
                ->leftJoin('category','category.categoryId','=','product.fkcategoryId')->where('product.productId',$productId)
                ->get()->toArray();

            $list=array_merge($list,$newlist);
        }

        //var_dump($newlist);



//        return $productList;
//
//        var_dump($productList);

       // $list = User::all()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list)
        {
            $FH = fopen(public_path ()."/csv/product.csv", "w");
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

      return Response::stream($callback, 200, $headers); //use Illuminate\Support\Facades\Response;
    }
}