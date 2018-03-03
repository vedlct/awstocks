<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;

class SettingsController extends Controller
{
    public function index(){

        return view('settings.index');
    }



    public function getColors(Request $r){

        if ($r->option=="color"){

            $colors=Color::get();

            return view('settings.color')
                ->with('colors',$colors);

        }




    }
}
