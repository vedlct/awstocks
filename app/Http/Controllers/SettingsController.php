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

        $this->validate($r,[
            'careName' => 'required|max:45',
            'careDescription' => 'max:45',
        ]);
        $care=new Care();
        $care->careName=$r->careName;
        $care->careDescription=$r->description;
        $care->save();

        return view('settings.care');
    }
    public function insertCategory(Request $r){

        $this->validate($r,[
            'categoryName' => 'required|max:45',
            'categoryDesc' => 'max:45',
        ]);
        $category=new Category();
        $category->categoryName=$r->caregoryname;
        $category->categoryDesc=$r->description;
        $category->save();
        return view('settings.category');

    }
    public function insertColor(Request $r){

        $this->validate($r,[
            'colorName' => 'required|max:45',
            'colorDescription' => 'max:45',
        ]);
        $color=new Color();
        $color->colorName=$r->colorname;
        $color->colorDescription=$r->description;
        $color->save();
        return view('settings.color');
    }
    public function insertRunToSize(Request $r){

        $this->validate($r,[
            'runToSizeName' => 'required|max:45',
            'runToSizeDescription' => 'max:45',
        ]);
        $runtosize=new RunToSize();
        $runtosize->runToSizeName=$r->runtosizename;
        $runtosize->runToSizeDescription=$r->description;
        $runtosize->save();
        return view('settings.runtosize');
    }


}
