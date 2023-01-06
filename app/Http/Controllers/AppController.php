<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;

class AppController extends Controller{
    public function getAppPage(Request $request){
        return view('/app');
    }
}
