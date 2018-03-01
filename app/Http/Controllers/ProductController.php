<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;
use Session;
use App\Product;
use App\Category;
use App\Color;
use Yajra\DataTables\DataTables;

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

        $dColors=Color::where('colorType','detailed')->get();
        return view('product.add')
            ->with('categories',$categories)
            ->with('sColors',$sColors)
            ->with('dColors',$dColors);
    }

    public function edit($id){

        $categories=Category::get();
        $sColors=Color::where('colorType','standard')
            ->get();

        $dColors=Color::where('colorType','detailed')->get();
        $product=Product::findOrFail($id);

        return view('product.edit')
            ->with('categories',$categories)
            ->with('sColors',$sColors)
            ->with('dColors',$dColors)
            ->with('product',$product)
            ->with('id',$id);
    }


    public function update(Request $r){
        $this->validate($r,[
            'productName' => 'required|max:45',
            'status' => 'max:45',
            'description' => 'required',
            'style' => 'required|max:45',
            'sku'=>'max:45',
            'brand'=>'max:45',
            'size'=>'required|max:5',

        ]);

        $product=Product::findOrFail($r->id);
        $product->productName=$r->productName;
        $product->status=$r->status;
        $product->productDecription=$r->description;
        $product->style=$r->style;
        $product->sku=$r->sku;
        $product->brand=$r->brand;
        $product->size=$r->size;
        $product->fkcategoryId=$r->category;
        $product->fkscolorId=$r->standardColor;
        $product->fkdcolorId=$r->detailedColor;
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
        $status=$r->status;

        if (empty($status)){

            return Datatables::of(Product::select('productId','style','sku','brand','status','productName','LastExportedBy','LastExportedDate','category.name as categoryName')
                ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
                ->get())->make(true);

        }
        else{

            return Datatables::of(Product::select('productId','style','sku','brand','status','productName','LastExportedBy','LastExportedDate','category.name as categoryName')
                ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
                ->where('status',$status)
                ->get())->make(true);


        }



    }



    public function insert(Request $r){
        /*use Image Plugin from http://image.intervention.io/getting_started/installation
        *
        *
        *
        */
        $this->validate($r,[
            'productName' => 'required|max:45',
            'status' => 'max:45',
            'description' => 'required',
            'style' => 'required|max:45',
            'sku'=>'max:45',
            'brand'=>'max:45',
            'size'=>'required|max:5',

        ]);

        $product=new Product();
        $product->productName=$r->productName;
        $product->status=$r->status;
        $product->productDecription=$r->description;
        $product->style=$r->style;
        $product->sku=$r->sku;
        $product->brand=$r->brand;
        $product->size=$r->size;
        $product->fkcategoryId=$r->category;
        $product->fkscolorId=$r->standardColor;
        $product->fkdcolorId=$r->detailedColor;
        $product->save();

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
}
