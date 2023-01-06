<?php

namespace App\Http\Controllers;

use App\Models\HealthTips;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Request;

class HealthTipsController extends Controller{
    public function getHealthTipsPage(Request $request){
        if(!session('id')){
            return redirect('/login');
        }     
        $tips = $this->getHealthTips($request);
        return view('/health_tips', ['health_tips' => $tips]);
    }

    public function getHealthTips(Request $request){
        $model = new HealthTips();
        $tips = $model->get_health_tips($request, $this->client, $this->url.'health_tips');
        return $tips;
    }

    public function deleteTip(Request $request){
        $model = new HealthTips();
        $tip = $model->delete_tip($request, $this->client, $this->url.'health_tip');
        return $tip;
    }    
}