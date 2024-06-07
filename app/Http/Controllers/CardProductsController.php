<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardProductsController extends Controller
{
    public static function store(Request $req) {
        $email = $req->input('email');
        $id = DB::table('cart')->select('productId')->where('email', $email)->get();
        $results = [];
        for($i = 0; $i<count($id); $i++) {
            $id1 = $id[$i];
            $a = DB::table('products')->where('id', $id1->productId)->first();
            array_push($results, $a);
        }
        $pics = DB::table('cart')->select('pics')->where('email', $email)->get();
        $size = DB::table('cart')->select('size')->where('email', $email)->get();
        $color = DB::table('cart')->select('color')->where('email', $email)->get();
        $cartId = DB::table('cart')->select('id')->where('email', $email)->get();
        return array($results, $pics, $size, $color, $cartId);
    }
    public static function removeProduct(Request $req) {
        $id = $req->input('id');
        $email = $req->input('email');

        DB::table('cart')->where('email', $email)->where('id', $id)->delete();
        return 'ok';
    }

    public static function changePics(Request $req) {
        $id = $req->input('id');
        $method = $req->input('method');

        $pics = DB::table('cart')->select('pics')->where('id', $id)->get();

        if($method == 0) {
            $pics = $pics[0]->pics - 1;
            if($pics === 0) {
                DB::table('cart')->where('id', $id)->delete();
                return 'row is removed';
            }
        } else if($method == 1) {
            $pics = $pics[0]->pics + 1;
        } else {
            return 'error';
        }
        DB::table('cart')->where('id', $id)->update(array('pics'=>$pics));
        return 'ok';
    }

    public static function changeColor(Request $req) {
//        $email = $req->input('email');
        $id = $req->input('id');
        $color = $req->input('color');

        DB::table('cart')->where('id', $id)->update(array('color'=>$color));
        return 'ok';
    }

    public static function changeSize(Request $req) {
//        $email = $req->input('email');
        $id = $req->input('id');
        $size = $req->input('size');

        DB::table('cart')->where('id', $id)->update(array('size'=>$size));
        return 'ok';
    }

    public static function productById(Request $req) {
        $id = $req->input('id');
        $results = DB::table('products')->where('id', $id)->get();
        return $results;
    }

    public static function favoriteProducts(Request $req) {
        $email = $req->input('email');
        $id = DB::table('favorite')->select('productId')->where('email', $email)->get();
        $results = [];
        for($i = 0; $i<count($id); $i++) {
            $id1 = $id[$i];
            $a = DB::table('products')->where('id', $id1->productId)->first();
            array_push($results, $a);
        }
        return array($results);
    }

    public static function removeFavorite(Request $req) {
        $id = $req->input('id');
        $email = $req->input('email');

        DB::table('favorite')->where('email', $email)->where('productId', $id)->delete();
        return 'ok';
    }
}
