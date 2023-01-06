<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller{
    public function getMovementPage(Request $request){
        if(!session('id')){
            return redirect('/login');
        }        

        $users = $this->getMovementsFromInfectedUsers($request);
        return view('/movement', ['users' => $users]);
    }

    public function getMovementsFromInfectedUsers(Request $request){
        $model = new Movement();
        $movements = $model->get_movements($request, $this->client ,$this->url.'dashboard/alerts');
        return $movements;
    }
}
