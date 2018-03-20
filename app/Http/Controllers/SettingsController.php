<?php

namespace App\Http\Controllers;


use App\Size;
use Session;
use Illuminate\Http\Request;
use App\Color;
use App\Category;
use App\Care;
use App\RunToSize;
use App\Season;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;


class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        }
        elseif ($r->option=="size"){

            return view('settings.size')->with('sizeType',$r->sizeType);


        }
        elseif ($r->option=="runtosize"){

            return view('settings.runtosize');

        }
        elseif ($r->option=="season"){

            return view('settings.season');

        }

    }

    //ajax controller to show color
    public function colorAjax () {
        $color = Color::get();
        $datatables = Datatables::of($color);
        return $datatables->make(true);
    }

    public function sizeAjax (Request $r) {
        $size = Size::where('sizeType',$r->type)
            ->get();
        $datatables = Datatables::of($size);
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

    public function season(){

        $season = Season::get();
        $datatables = Datatables::of($season);
        return $datatables->make(true);
    }


    ///////insert settings////////////


    public function addSeason(){

        return view('settings.insertSeason');
    }


    public function insertSeason(Request $r){
        $this->validate($r,[
            'seasonName' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);



        $season=new Season;
        $season->seasonName=$r->seasonName;
        $season->startDate=$r->startDate;
        $season->endDate=$r->endDate;
        $season->save();

        Session::flash('message', 'Season Inserted successfully');
        return back();
    }

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

    public function addSize(Request $r){

        return view('settings.insertsize')->with('sizeType',$r->type);
    }
    public function insertSize(Request $r){


//        $this->validate($r,[
//            'sizeName' => 'required|max:45',
//            'sizeDescription' => 'max:45',
//            'sizeType' => 'required|max:45',
//        ]);

        $size=new Size;
        $size->sizeName=$r->sizeName;
        $size->sizeDescription=$r->sizeDescription;
        $size->sizeType=$r->sizeType;
        $size->save();
        Session::flash('message','Size Inserted successfully');

        return view('settings.insertsize')->with('sizeType',$r->sizeType);
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

    public function editSeason($id){
        $season=Season::findOrFail($id);

        return view('settings.edit.editseason')->with('season',$season);

    }

    public function editColor($id){
        $color=Color::findOrFail($id);
        return view('settings.edit.editcolor')->with('color',$color);
    }

    public function editSize($id){
        $size=Size::findOrFail($id);
        return view('settings.edit.editsize')->with('size',$size);
    }

    public function editCategory($id){
        $category=Category::findOrFail($id);

        return view('settings.edit.editcategory')->with('category',$category);

    }

    public function editCare($id){
        $care=Care::findOrFail($id);
        return view('settings.edit.editcare')->with('care',$care);

    }

    public function editRunToSize($id){
        $runToSize=RunToSize::findOrFail($id);
        return view('settings.edit.editruntosize')->with('runToSize',$runToSize);

    }

//Update Settings

    public function updateSeason(Request $r){
        $this->validate($r,[
            'id' => 'required',
            'seasonName' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);
        $season=Season::findOrFail($r->id);
        $season->seasonName=$r->seasonName;
        $season->startDate=$r->startDate;
        $season->endDate=$r->endDate;
        $season->save();

        Session::flash('message', 'Season Inserted successfully');

        Session::flash('Cat','season');

        return redirect()->route('settings');




    }

    public function updateCare(Request $r){
        $this->validate($r,[
            'careName' => 'required|max:45',
            'careDescription' => 'max:45',
        ]);
        $care=Care::findOrFail($r->id);
        $care->careName=$r->careName;
        $care->careDescription=$r->careDescription;
        $care->save();
        Session::flash('message', 'Care Updated successfully');

        Session::flash('Cat','care');

        return redirect()->route('settings');

        //return back();


    }

    public function updateColor(Request $r){
        $this->validate($r,[
            'colorName' => 'required|max:45',
            'colorDescription' => 'max:45',
        ]);
        $color=Color::findOrFail($r->id);
        $color->colorName=$r->colorName;
        $color->colorDescription=$r->colorDescription;
        $color->save();
        Session::flash('message', 'Color Updated successfully');

        Session::flash('Cat','color');

        return redirect()->route('settings');

        //return back();


    }

    public function updateSize(Request $r){

//        $this->validate($r,[
//            'sizeName' => 'required|max:45',
//            'sizeDescription' => 'max:45',
//            'sizeType' => 'required|max:45',
//        ]);
        $size=Size::findOrFail($r->id);
        $size->sizeName=$r->sizeName;
        $size->sizeDescription=$r->sizeDescription;
        $size->sizeType=$r->sizeType;
        $size->save();
        Session::flash('message','Size Updated successfully');

        Session::flash('Cat','size');
        Session::flash('sizeType',$size->sizeType);

        return redirect()->route('settings');

        //return view('settings.insertsize')->with('sizeType',$r->sizeType);

    }

    public function updateCategory(Request $r){
        $this->validate($r,[
            'categoryName' => 'required|max:45',
            'categoryDesc' => 'max:45',
        ]);
        $category=Category::findOrFail($r->id);
        $category->categoryName=$r->categoryName;
        $category->categoryDesc=$r->categoryDesc;
        $category->save();
        Session::flash('message', 'Category Updated successfully');
        Session::flash('Cat','category');

        return redirect()->route('settings');
       // return back();

    }

    public function updateRunToSize(Request $r){
        $this->validate($r,[
            'runToSizeName' => 'required|max:45',
            'runToSizeDescription' => 'max:45',
        ]);
        $runtosize=RunToSize::findOrFail($r->id);
        $runtosize->runToSizeName=$r->runToSizeName;
        $runtosize->runToSizeDescription=$r->runToSizeDescription;
        $runtosize->save();
        Session::flash('message', 'Run To Size Updated successfully');

        Session::flash('Cat','runtosize');

        return redirect()->route('settings');

        //return back();


    }

//Delete
    public function destroyColor($id){
        $color=Color::findOrFail($id);
        $color->delete();
        Session::flash('message', 'Color Deleted successfully');
        Session::flash('Cat','color');

        return redirect()->route('settings');
       // return back();
    }

    public function destroyCategory($id){
        $category=Category::findOrFail($id);
        $category->delete();
        Session::flash('message', 'Category Deleted successfully');
        Session::flash('Cat','category');

        return redirect()->route('settings');
        //return back();
    }

    public function destroyCare($id){
        $care=Care::findOrFail($id);
        $care->delete();
        Session::flash('message', 'Care Deleted successfully');


        Session::flash('Cat','care');

        return redirect()->route('settings');

       // return back();
    }

    public function destroyRunToSize($id){
        $runToSize=RunToSize::findOrFail($id);
        $runToSize->delete();
        Session::flash('message', 'Run To Size Deleted successfully');

        Session::flash('Cat','runtosize');

        return redirect()->route('settings');

        //return back();
    }

    public function destroySize($id){
        $size=Size::findOrFail($id);
        $size->delete();
        Session::flash('message', 'Size Deleted successfully');

        Session::flash('Cat','size');
        Session::flash('sizeType',$size->sizeType);

        return redirect()->route('settings');
        //return back();
    }



}
