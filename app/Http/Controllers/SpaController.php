<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    //  マップページ表示
    public function map() {
	Log::info('mapにアクセスしました。');    
        return view('map');
    }

    // マップ登録ページ表示
    public function serch() {
        return view('serch');
    }

    // マップ登録ページpost
    public function map_store(Request $request) {
        $spas = new Spa();
        $spas->spa_lat = $request->input('spa_lat');
        $spas->spa_lng = $request->input('spa_lng');
        $spas->spa_address = $request->input('spa_address');
        $spas->spa_name = $request->input('spa_name');
        $spas->spa_type = $request->input('spa_type');
        $spas->spa_price = $request->input('spa_price');
        $spas->spa_point = $request->input('spa_point');
        $spas->save();
        return view('/map', compact('spas'));
    }




    // お問合せ画面
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('create');
    }

    // お問合せpost
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $contacts = new Contact();
        $contacts->name = $request->input('name');
        $contacts->sex = $request->input('sex');
        $contacts->mail = $request->input('mail');
        $contacts->tel = $request->input('tel');
        $contacts->contactText = $request->input('contactText');
        $contacts->save();
        return redirect()->route('index')->with('flash_message', '投稿が完了しました。');
    }
    
    public function index() {
        $contacts = Contact::get();
        return view('index', compact('contacts'));
    }
}


