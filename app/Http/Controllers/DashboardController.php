<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller{
    public function getDashboardPage(Request $request){
        if(!session('id')){
            return redirect('/login');
        }        

        $cards = $this->getInfoForCards($request);
        return view('/dashboard', ['cards' => $cards]);
    }

    public function getInfoForCards(Request $request){
        $model = new Dashboard();
        $cards = $model->get_info_for_cards($request, $this->client ,$this->url.'dashboard/cards');
        return $cards;
    }   

    public function getSeriesForTotalCasesOfYearChart(Request $request){
        $model = new Dashboard();
        $series = $model->get_series_for_cases_year($request, $this->client ,$this->url.'dashboard/series');
        return $series;
    }
}
