<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;


class Movement extends Model{
    use HasFactory;

    public function get_movements(Request $request, $clientHTTP, string $url){
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
