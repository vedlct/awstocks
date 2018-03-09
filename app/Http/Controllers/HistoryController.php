<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Historicuploadedfiles;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        return view('history.index');
    }



    public function getHistoryData(Request $r){

        $history=Historicuploadedfiles::select('historicUploadedFilesName','historicUploadedFilesType','createDate','createdBy');
        if($r->categoryId !=null){
            $history=$history->where('historicUploadedFilesType',$r->categoryId);
        }

        $history=$history->orderBy('historicUploadedFilesId','desc')->get();

        $datatables = Datatables::of($history);
        return $datatables->make(true);

    }

}
