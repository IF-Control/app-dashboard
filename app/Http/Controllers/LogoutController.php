<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller{
    public function handle(Request $req){
        $req->session()->flush();
        return redirect('/login');
    }
}
