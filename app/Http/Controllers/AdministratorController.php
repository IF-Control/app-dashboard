<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;

class AdministratorController extends Controller{
    public function getAdministratorPage(Request $request){
        if(!session('id')){
            return redirect('/login');
        } 
        $administrators = $this->getAdms($request);
        return view('/administrator', ['administrators' => $administrators]);
    }

    public function addAdm(Request $request){
        $model = new Administrator();
        $adm = $model->add_adm($request, $this->client ,$this->url.'user/admin');
        return $adm;
    }

    public function getAdms(Request $request){
        $model = new Administrator();
        $adms = $model->get_adms($request, $this->client ,$this->url.'user/admin');
        return $adms;
    }

    public function updateAdm(Request $request){
        $model = new Administrator();
        $adm = $model->update_adm($request, $this->client ,$this->url.'user/admin');
        return $adm;
    }

    public function deleteAdm(Request $request){
        $model = new Administrator();
        $adm = $model->delete_adm($request, $this->client ,$this->url.'user/admin');
        return $adm;
    }   

    public function getMyAccountPage(Request $request){
        if(!session('id')){
            return redirect('/login');
        } 
        $me = $this->getMyInformation($request);
        return view('/my_account', ['me' => $me]);
    }

    public function getMyInformation(Request $request){
        $model = new Administrator();
        $adm = $model->my_information($request, $this->client ,$this->url.'me');
        return $adm;
    }
    
    public function updateAccount(Request $request){
        $model = new Administrator();
        $adm = $model->update_account($request, $this->client ,$this->url.'user/admin/edit');
        return $adm;
    }
}
