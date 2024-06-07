<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public static function store() {
        $results = DB::table('products')->get();
        return array($results);
    }
}
