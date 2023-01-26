<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

trait LoginTrait {

    /**
     * Carregar página de login
     * @return void
     */
    public function traitIndex() {

        if (Auth::guard($this->guard)->check()) {
            Session::flash('error', 'Não é possível acessar essa tela. Você já está logado na plataforma.');
            return redirect(dynUrl('/'));

        } else {
            return view($this->baseViewPath.'auth.login');
        }

    }

    /**
     * Realizar login
     * @param Request $request
     * @return void
     */
    public function traitLogin(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255'
        ]);

        $user = $this->model::where('email', $request->email)->first();

        $validator->after(function($validator) use ($request, $user) {

            if ($user) {

                $hashCheck = Hash::check($request->password, $user->password);

                if ($hashCheck == false) {
                    $validator->errors()->add('password', 'Senha incorreta.');
                }

            } else {
                $validator->errors()->add('user', 'Nenhum usuário foi encontrado com essas credenciais');
            }

        });

        if (!$validator->fails()) {

            if (!$user->blocked) {

                // Verificar se foi aprovado, caso seja coordenador de curso
                if ($this->guard == 'course-coordinator' && !$user->approved) {

                    $reason = $user->approved === false ? 'foi rejeitado' : 'ainda não foi aprovado por um administrador';

                    return back()->withErrors("Não é possível realizar o login pois seu cadastro ".$reason)->withInput();

                }

                // Realizar o login e redirecionar para a home
                Auth::guard($this->guard)->login($user, ($request->remember ? true : false));
                return dynRedirect('/');

            } else {
                return back()->withErrors("Não é possível realizar o login pois sua conta foi bloqueada por um administrador")->withInput();
            }

        } else {
            return back()->withErrors($validator->errors()->first())->withInput();
        }

    }

    /**
     * Realizar logout
     * @return void
     */
    public function traitLogout() {

        if (Auth::guard($this->guard)->check()) {
            Auth::guard($this->guard)->logout();

        } else {
            return back()->withErrors('Não foi possível realizar o logout. Você não está conectado na plataforma.');
        }

        return dynRedirect('login');

    }

}
