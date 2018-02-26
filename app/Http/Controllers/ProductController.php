<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(){

        return view('product.add');
    }




    public function generate(){
        return view('product.generate');
    }


    public function insert(Request $r){

        return $r;

    }

    public function Store(){

    }
}
