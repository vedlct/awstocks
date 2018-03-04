<?php

namespace App\Http\Controllers;


use Session;
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
        $care->careDescription=$r->careDescription;
        $care->save();

        Session::flash('message', 'Care Inserted successfully');
        return back();
    }
    public function insertCategory(Request $r){



        $this->validate($r,[
            'categoryName' => 'required|max:45',
            'categoryDesc' => 'max:45',
        ]);
        $category=new Category();
        $category->categoryName=$r->categoryName;
        $category->categoryDesc=$r->categoryDesc;
        $category->save();
        Session::flash('message', 'Category Inserted successfully');
        return back();

    }
    public function insertColor(Request $r){


        $this->validate($r,[
            'colorName' => 'required|max:45',
            'colorDescription' => 'max:45',
        ]);
        $color=new Color();
        $color->colorName=$r->colorName;
        $color->colorDescription=$r->colorDescription;
        $color->save();
        Session::flash('message', 'Color Inserted successfully');
        return back();
    }
    public function insertRunToSize(Request $r){

        $this->validate($r,[
            'runToSizeName' => 'required|max:45',
            'runToSizeDescription' => 'max:45',
        ]);
        $runtosize=new RunToSize();
        $runtosize->runToSizeName=$r->runToSizeName;
        $runtosize->runToSizeDescription=$r->runToSizeDescription;
        $runtosize->save();
        Session::flash('message', 'Run To Size Inserted successfully');
        return back();
    }

//Edit

    public function editColor($id){
        $color=Color::findOrFail($id);
        return $color;
    }

    public function editCategory($id){
        $category=Category::findOrFail($id);

        return $category;
    }

    public function editCare($id){
        $care=Care::findOrFail($id);
        return $care;
    }

    public function editRunToSize($id){
        $runToSize=RunToSize::findOrFail($id);

        return $runToSize;
    }

//Delete
    public function destroyColor($id){
        $color=Color::findOrFail($id);
        $color->delete();
        Session::flash('message', 'Color Deleted successfully');
        return back();
    }

    public function destroyCategory($id){
        $category=Category::findOrFail($id);
        $category->delete();
        Session::flash('message', 'Category Deleted successfully');
        return back();
    }

    public function destroyCare($id){
        $care=Care::findOrFail($id);
        $care->delete();
        Session::flash('message', 'Care Deleted successfully');
        return back();
    }

    public function destroyRunToSize($id){
        $runToSize=RunToSize::findOrFail($id);
        $runToSize->delete();
        Session::flash('message', 'Run To Size Deleted successfully');
        return back();
    }



}
