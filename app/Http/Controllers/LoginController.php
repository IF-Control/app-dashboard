<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller{
    public function handle(Request $request){
        $messages = [
            'email.email' => 'Usuário e/ou senha incorretos.'
        ];

        $request->validate([
            'email' => 'required|max:52|min:6|email:rfc,dns',
            'passwd' => 'required|min:6|max:18', // tem que ter números, caracteres especiais, maiúsculas e minúsculas
        ], $messages);

        $email = $request->email;
        $passwd = $request->passwd;

        $user = array('email' => $email, 'password' => $passwd);

        $loginModel = new Login();
        if($loginModel->execute($request, $user, $this->client, $this->url.'session') == 200){
            return redirect('/');
        }else{
            return redirect('/login')->withErrors($messages)->withInput($request->all());
        }
    }
}
