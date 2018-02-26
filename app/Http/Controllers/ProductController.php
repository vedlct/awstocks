<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Session;
use App\Product;
use App\Category;
use App\Color;
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




    public function generate(){
        return view('product.generate');
    }


    public function insert(Request $r){
        /*use Image Plugin from http://image.intervention.io/getting_started/installation
        *
        *
        *
        */

        $product=new Product();
        $product->productName=$r->productName;
        $product->status=$r->status;
        $product->productDecription=$r->description;
        $product->style=$r->style;
        $product->sku=$r->sku;
        $product->brand=$r->brand;
        $product->size=$r->size;
        $product->fkcategoryId=$r->category;
        $product->sColor=$r->standardColor;
        $product->dColor=$r->detailedColor;

        if($r->hasFile('swatchPic')){


            $img = $r->file('swatchPic');
            $filename= time().'swatch'.'.'.$img->getClientOriginalExtension();
            $product->swatch=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);

        }

        if($r->hasFile('outfitPic')){
            $img = $r->file('outfitPic');
            $filename= time().'outfit'.'.'.$img->getClientOriginalExtension();
            $product->outfit=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('mainPic')){
            $img = $r->file('mainPic');
            $filename= time().'main'.'.'.$img->getClientOriginalExtension();
            $product->mainImage=$filename;
            $location = public_path('productImage/'.$filename);
            Image::make($img)->resize(300,200)->save($location);
        }
        if($r->hasFile('image2Pic')){
            $img = $r->file('image2Pic');
            $filename= time().'image2'.'.'.$img->getClientOriginalExtension();
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

    }
}
