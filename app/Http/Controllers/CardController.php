<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public static function store(Request $req) {
        $productId = $req->input('id');
        $email = $req->input('email');
        $color = $req->input('color');
        $size = $req->input('size');
        $records = DB::table('cart')->where('email', $email)->where('productId', $productId)->where('color', $color)->where('size', $size)->get();
        if(count($records) !== 0) {
//            if ($records[0]->color == $color || $records[0]->size == $size) {
                $pics = DB::table('cart')->select('pics')->where('email', $email)->where('productId', $productId)->where('color', $color)->where('size', $size)->get();
//        return array($pics[0]->pics);
                $pics = $pics[0]->pics + 1;
                DB::table('cart')->where('email', $email)->where('productId', $productId)->where('color', $color)->where('size', $size)->update(array('pics' => $pics));
//            } else {
//                DB::insert('insert into cart(productId, email, color, size, pics) values(?, ?, ?, ?, ?)', [$productId, $email, $color, $size, 1]);
//            }
        } else {
        DB::insert('insert into cart(productId, email, color, size, pics) values(?, ?, ?, ?, ?)', [$productId, $email, $color, $size, 1]);
        }

//        return DB::table('card')->select('pics')->where('email', $email)->where('productId', $productId)->get();
    }

    public static function addToFavorite(Request $req) {
        $productId = $req->input('id');
        $email = $req->input('email');
        $records = DB::table('favorite')->where('email', $email)->where('productId', $productId)->get();
        if(count($records) == 0) {
            DB::insert('insert into favorite(productId, email) values(?, ?)', [$productId, $email]);
        }
    }
}
