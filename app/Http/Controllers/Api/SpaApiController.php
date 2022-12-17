<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spa;

class SpaApiController extends Controller
{
    public function index () {
        $spas=Spa::all();
        return $spas;
    }
}
