<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class Dashboard extends Model{
    use HasFactory;
    
    public static function get_info_for_cards(Request $request, $clientHTTP, string $url){
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

    public static function get_series_for_cases_year(Request $request, $clientHTTP, string $url){
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
