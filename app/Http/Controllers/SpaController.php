<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function home()
    {
        return view('home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function serch()
    {
        return view('serch');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spa  $spa
     * @return \Illuminate\Http\Response
     */
    public function show(Spa $spa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spa  $spa
     * @return \Illuminate\Http\Response
     */
    public function edit(Spa $spa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spa  $spa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spa $spa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spa  $spa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spa $spa)
    {
        //
    }
}
