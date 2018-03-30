<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use App\Product;
use App\Category;
use Yajra\DataTables\DataTables;


class StockController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Showinfo() {

        $stockinfo = Product::select('productId','product.created_at','style','sku','brand','product.status','productName','mainImage','stockQty','minQtyAlert','location','price','color','size','category.categoryName as categoryName')
            ->leftJoin('category', 'category.categoryId', '=', 'product.fkcategoryId')
            ->orderBy('product.created_at','desc')
            ->get();
        $datatables = Datatables::of($stockinfo);
        return $datatables->make(true);

    }
}
