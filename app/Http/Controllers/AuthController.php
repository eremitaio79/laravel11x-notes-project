<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Exibe a página de login.
     */
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16',
            ],
            [
                'text_username.required' => 'O campo nome de usuário é obrigatório.',
                'text_username.email' => 'O usuário deve ser um e-mail válido.',
                'text_password.required' => 'O campo senha é obrigatório.',
                'text_password.min' => 'A senha deve ter pelo menos 6 caracteres.',
                'text_password.max' => 'A senha não pode ter mais de 16 caracteres.',
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // Verifica se o usuário existe no banco de dados.
        $user = User::where('username', $username)
            ->whereNull('deleted_at')
            ->first();

        if (!$user || !password_verify($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Usuário ou senha incorretos.');
        }

        // Atualiza a coluna last_login do usuário.
        $user->last_login = now();
        $user->save();

        // Coloca os dados do usuário na sessão.
        session([
            'user_id' => $user->id,
            'user_name' => $user->username,
            'user_last_login' => $user->last_login,
        ]);

        return redirect()->route('home')
            ->with('loginSuccess', 'Login realizado com sucesso!');
    }


    /**
     * Exibe a página de registro.
     */
    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_last_login']);

        return redirect('/login')
            ->with('logoutSuccess', 'Você encerrou a sessão com sucesso!');
    }
}
