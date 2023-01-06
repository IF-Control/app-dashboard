<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class Administrator extends Model{
    use HasFactory;

    public function add_adm(Request $request, $clientHTTP, string $url){
        $nome = $request->nome;
        $email = $request->email;
        $senha = $request->senha;
        $token = $request->session()->get('token');

        try{
            $res = $clientHTTP->request('POST', $url,[
                'json' => [
                    'name' => $nome,
                    'email' => $email,
                    'password' =>  $senha
                ],
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);
            return $res->getBody();
        }catch(RequestException $e){
            $error = $e->getResponse()->getBody()->getContents();
            return json_decode($error, true);
        }
    }

    public function get_adms(Request $request, $clientHTTP, string $url){
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

    public function delete_adm(Request $request, $clientHTTP, string $url){
        $id = $request->id;
        $token = $request->session()->get('token');
        try{
            $res = $clientHTTP->request('DELETE', $url,[
                'json' => [
                    'id' => $id
                ],
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return true;
        }catch(RequestException $e){
            return false;
        }
    }

    public function update_adm(Request $request, $clientHTTP, string $url){
        $id = $request->id;
        $active = $request->status == 0 ? false : true;
        $name = $request->name;
        $token = $request->session()->get('token');

        try{
            $res = $clientHTTP->request('PATCH', $url,[
                'json' => [
                    'id' => $id,
                    'name' => $name,
                    'active' => $active
                ],
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            return json_decode($res->getBody(), true);
        }catch(RequestException $e){
            $error = $e->getResponse()->getBody()->getContents();
            return json_decode($error, true);
        }
    }

    public function my_information(Request $request, $clientHTTP, string $url){
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

    public function update_account(Request $request, $clientHTTP, string $url){
        $id = $request->id;
        $password = $request->senha;
        $name = $request->nome;
        $userData = explode(" ", $name);
        $token = $request->session()->get('token');

        try{
            $res = $clientHTTP->request('PATCH', $url,[
                'json' => [
                    'id' => $id,
                    'name' => $name,
                    'password' => $password
                ],
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);

            $request->session()->put('firstName', $userData[0]);

            return json_decode($res->getBody(), true);
        }catch(RequestException $e){
            $error = $e->getResponse()->getBody()->getContents();
            return json_decode($error, true);
        }
    }
}
