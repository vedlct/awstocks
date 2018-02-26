<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return $r;

    }

    public function Store($val){

        return $val;
    }

    public function destroy($id){

    }
}
