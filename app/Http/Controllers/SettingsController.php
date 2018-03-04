<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Color;
use App\Category;
use App\Care;
use App\RunToSize;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;

class SettingsController extends Controller
{
    public function index(){

        return view('settings.index');
    }



    public function getColors(Request $r){

        if ($r->option=="color"){

            return view('settings.color');

        } elseif ($r->option=="category"){

            return view('settings.category');

        }elseif ($r->option=="care"){

            return view('settings.care');

        }elseif ($r->option=="runtosize"){

            return view('settings.runtosize');

        }

    }

    //ajax controller to show color
    public function colorAjax () {
        $color = Color::get();
        $datatables = Datatables::of($color);
        return $datatables->make(true);
    }
    //ajax controller to show category
    public function categoryAjax (){
        $category = Category::get();
        $datatables = Datatables::of($category);
        return $datatables->make(true);
    }
    //ajax controller to show care
    public function careAjax (){
        $care = Care::get();
        $datatables = Datatables::of($care);
        return $datatables->make(true);
    }
    //ajax controller to show runtosize
    public function runToSizeAjax (){
        $runtosize = RunToSize::get();
        $datatables = Datatables::of($runtosize);
        return $datatables->make(true);
    }


    ///////insert settings////////////

    public function insertCare(Request $r){


    }
    public function insertCategory(Request $r){

    }
    public function insertColor(Request $r){

    }
    public function insertRunToSize(Request $r){

    }


}
