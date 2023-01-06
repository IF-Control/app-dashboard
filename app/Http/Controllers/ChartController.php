<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use Illuminate\Http\Request;

class ChartController extends Controller{
    public function getChartPage(Request $request){
        if(!session('id')){
            return redirect('/login');
        }     
        return view('/charts');
    }

    public function getSeriesForCasesByYearChart(Request $request){
        $model = new Chart();
        $series = $model->get_series_for_cases_by_year($request, $this->client ,$this->url.'dashboard/cases_by_year');
        return $series;
    }

    public function getPercentageOfVaccineChart(Request $request){
        $model = new Chart();
        $percentage = $model->get_percentage_of_vaccine($request, $this->client ,$this->url.'dashboard/vaccine_doses');
        return $percentage;
    }

    public function getPercentageOfRiskGroupChart(Request $request){
        $model = new Chart();
        $percentage = $model->get_percentage_of_risk_group($request, $this->client ,$this->url.'dashboard/group_risk');
        return $percentage;
    }

    public function getSeriesForCasesByCourseChart(Request $request){
        $model = new Chart();
        $series = $model->get_series_for_cases_by_course($request, $this->client ,$this->url.'dashboard/cases_by_course');
        return $series;
    }

    public function getSeriesForCasesByMonthChart(Request $request){
        $model = new Chart();
        $series = $model->get_series_for_cases_by_month($request, $this->client ,$this->url.'dashboard/series');
        return $series;
    }    
}