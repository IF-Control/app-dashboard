<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use Illuminate\Http\Request;

class EnvironmentController extends Controller{
    public function getEnvironmentPage(Request $request){
        if(!session('id')){
            return redirect('/login');
        }        

        $environments = $this->getEnvironments($request);
        $rooms = $this->getRooms($request);
        $buildings = $this->getBuildings($request);
        return view('/environment', ['environments' => $environments, 'rooms' => $rooms,  'buildings' => $buildings]);
    }

    public function addBuilding(Request $request){
        $model = new Environment();
        $new_building = $model->add_building($request, $this->client, $this->url.'buildings');
        return $new_building;
    }

    public function getEnvironments(Request $request){
        $model = new Environment();
        $environments = $model->get_environments($request, $this->client ,$this->url.'environments');
        return $environments;
    }

    public function getBuildings(Request $request){
        $model = new Environment();
        $buildings = $model->get_buildings($request, $this->client ,$this->url.'buildings');
        return $buildings;
    }

    public function editBuilding(Request $request){
        $model = new Environment();
        $building = $model->edit_building($request, $this->client, $this->url.'buildings');
        return $building;
    }

    public function addRoom(Request $request){
        $model = new Environment();
        $room = $model->add_room($request, $this->client, $this->url.'rooms');
        return $room;
    }

    public function getRooms(Request $request){
        $model = new Environment();
        $rooms = $model->get_rooms($request, $this->client ,$this->url.'rooms');
        return $rooms;
    }

    public function editRoom(Request $request){
        $model = new Environment();
        $room = $model->edit_room($request, $this->client, $this->url.'rooms');
        return $room;
    }

    public function deleteRoom(Request $request){
        $model = new Environment();
        $room = $model->delete_room($request, $this->client, $this->url.'rooms');
        return $room;
    }
}

