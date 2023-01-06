<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class Chart extends Model{
    use HasFactory;

    public static function get_series_for_cases_by_year(Request $request, $clientHTTP, string $url){
        $token = $request->session()->get('token');
        try{
            $res = $clientHTTP->request('GET', $url,[
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return json_decode($res->getBody(), true);
        }catch(RequestException $e){
            return $e->getMessage();
        }
    }

    public static function get_percentage_of_vaccine(Request $request, $clientHTTP, string $url){
        $token = $request->session()->get('token');
        try{
            $res = $clientHTTP->request('GET', $url,[
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return json_decode($res->getBody(), true);
        }catch(RequestException $e){
            return $e->getMessage();
        }
    }

    public static function get_percentage_of_risk_group(Request $request, $clientHTTP, string $url){
        $token = $request->session()->get('token');
        try{
            $res = $clientHTTP->request('GET', $url,[
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return json_decode($res->getBody(), true);
        }catch(RequestException $e){
            return $e->getMessage();
        }
    }
    
    public static function get_series_for_cases_by_course(Request $request, $clientHTTP, string $url){
        $token = $request->session()->get('token');
        try{
            $res = $clientHTTP->request('GET', $url,[
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return json_decode($res->getBody(), true);
        }catch(RequestException $e){
            return $e->getMessage();
        }
    }

    public static function get_series_for_cases_by_month(Request $request, $clientHTTP, string $url){
        $token = $request->session()->get('token');
        try{
            $res = $clientHTTP->request('GET', $url,[
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return json_decode($res->getBody(), true);
        }catch(RequestException $e){
            return $e->getMessage();
        }
    }    
}
