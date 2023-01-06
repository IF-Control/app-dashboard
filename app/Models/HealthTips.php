<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class HealthTips extends Model{
    use HasFactory;

    public function get_health_tips(Request $request, $clientHTTP, string $url){
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

    public function delete_tip(Request $request, $clientHTTP, string $url){
        $id = $request->id;
        $token = $request->session()->get('token');
         
        try{
            $res = $clientHTTP->request('DELETE', $url.'?id='.$id,[
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);
            return true;
        }catch(RequestException $e){
            return false;
        }
    }    
}