<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class Environment extends Model{
    use HasFactory;

    public function add_building(Request $request, $clientHTTP, string $url){
        $nome = $request->nome;
        $campus_id = 'ce7a3707-55d7-49c1-b092-b9227df39433';
        $token = $request->session()->get('token');

        try{
            $res = $clientHTTP->request('POST', $url,[
                'json' => [
                    'name' => $nome,
                    'campus_id' => $campus_id
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

    public static function get_environments(Request $request, $clientHTTP, string $url){
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

    public static function get_buildings(Request $request, $clientHTTP, string $url){
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

    public function edit_building(Request $request, $clientHTTP, string $url){
        $novo_nome = $request->nome;
        $id = $request->id;
        $token = $request->session()->get('token');

        try{
            $res = $clientHTTP->request('PATCH', $url,[
                'json' => [
                    'id' => $id,
                    'name' => $novo_nome
                ],
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);
            return redirect('/environments');
        }catch(RequestException $e){
            return redirect('/environments');
        }
    }

    public function add_room(Request $request, $clientHTTP, string $url){
        $nome = $request->nome;
        $predio = $request->predio;
        $capacidade = intVal($request->capacidade);
        $status = $request->status;
        $tipo = $request->tipo;
        $token = $request->session()->get('token');
        
        try{
            $res = $clientHTTP->request('POST', $url,[
                'json' => [
                    'name' => $nome,
                    'capacity' => $capacidade,
                    'latitude' => '0',
                    'longitude' => '0',
                    'altitude' => '0',
                    'type' => $tipo,
                    'status' => $status,
                    'building_id' => $predio,
                ],
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);
            // $request->session()->flash('alert-success', 'Cadastro realizado com sucesso! Faça login');
            return redirect('/environments');
        }catch(RequestException $e){
            // $request->session()->flash('alert-danger', 'Ops... Ocorreu um erro, por favor tente novamente.');
            return redirect('/environments');
        }
    }

    public static function get_rooms(Request $request, $clientHTTP, string $url){
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

    public function edit_room(Request $request, $clientHTTP, string $url){
        $id = $request->id;
        $nome = $request->nome;
        $capacidade = intVal($request->capacidade);
        $status = $request->status;
        $tipo = $request->tipo;
        $token = $request->session()->get('token');
        
        try{
            $res = $clientHTTP->request('PATCH', $url,[
                'json' => [
                    'id' => $id,
                    'name' => $nome,
                    'capacity' => $capacidade,
                    'type' => $tipo,
                    'status' => $status,
                ],
                'headers' => [
                    'Authorization' => "Bearer {$token}"
                ]
            ]);
            return redirect('/environments');
        }catch(RequestException $e){
            return redirect('/environments');
        }
    }

    public function delete_room(Request $request, $clientHTTP, string $url){
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
}
