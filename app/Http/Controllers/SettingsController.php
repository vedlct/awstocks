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


    }
    public function insertCategory(Request $r){

    }
    public function insertColor(Request $r){

    }
    public function insertRunToSize(Request $r){

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
