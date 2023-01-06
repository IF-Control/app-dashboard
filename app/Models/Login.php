<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class Login extends Model{
    public static function execute(Request $request, array $user, $clientHTTP, string $url){
        try{
            $res = $clientHTTP->request('POST', $url, [
                'json' => [
                    'email' => $user['email'],
                    'password' => $user['password']
                ]
            ]);

            $data = json_decode($res->getBody());

            if($data->type != 'Administrador'){
                return false;
            }

            $userData = explode(" ", $data->name);

            $request->session()->put('id', $data->id);
            $request->session()->put('email', $data->email);
            $request->session()->put('campus', $data->campus);
            $request->session()->put('type', $data->type);
            $request->session()->put('firstName', $userData[0]);
            $request->session()->put('completeName', $data->name);
            $request->session()->put('token', $data->token);

            return $res->getStatusCode();
        }catch(RequestException $e){
            return $e->getMessage();
        }
    }
}
