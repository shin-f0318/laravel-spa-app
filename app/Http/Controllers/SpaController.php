<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    // トップページ表示
    public function top() {
        return view('top');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  一覧ページ表示
    public function index() {
        return view('index');
    }

    // マップ登録ページ表示
    public function serch() {
        return view('serch');
    }

    // マップ登録ページpost
    public function map_store(Request $request) {
        $spas = new Spa ();
        $spas->spa_address = $request->input('spa_address');
        $spas->spa_name = $request->input('spa_name');
        $spas->spa_type = $request->input('spa_type');
        $spas->spa_price = $request->input('spa_price');
        $spas->spa_point = $request->input('spa_point');
        return view('/index', compact('spas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return view('create');
    }
}
