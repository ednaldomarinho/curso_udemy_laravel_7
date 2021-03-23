<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
       $erro = '';
        if($request->get('erro') == 1){
            $erro = 'Usuário e/ou senha não existe';
        }
        if($request->get('erro') == 2){
            $erro = 'Necessário efetuar login para acesso';
        }
        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request)
    {
        //regras de validação

        $regras = [
            'usuario' => 'required|email',
            'senha' => 'required',
        ];

        //mensagens feedback
        $feedback = [
            'usuario.required' => 'O campo e-mail é obrigatório',
            'usuario.email' => 'Formato de e-mail não válido',
            'senha.required' => 'O campo senha é obrigatório',
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password  = $request->get('senha');

        
        //iniciar o model User

        $user = new User();
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if (isset($usuario->name)) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            return redirect()->route('app.home');
        }else {

            //echo "Usuário não existe";
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index');

    }
}
