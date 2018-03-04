<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;

class SettingsController extends Controller
{
    public function index(){

        return view('settings.index');
    }



    public function getColors(Request $r){

        if ($r->option=="color"){

         //   $colors=Color::get();

            return view('settings.color');
              //  ->with('colors',$colors);

        }




    }

    public function colorAjax () {
        $color = Color::get();
        $datatables = Datatables::of($color);
        return $datatables->make(true);
    }
}
