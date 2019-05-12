<?php

namespace App\Http\Controllers\Minimart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        return view('minimart.index.index');
    }
}
