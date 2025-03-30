<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }


    public function loginSubmit(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'text_username' => 'required',
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

        // echo 'OK';

        // Teste de conexão com o banco de dados.
        // try {
        //     DB::connection()->getPdo();
        //     echo "Conexão com o banco de dados estabelecida com sucesso.";
        // } catch (\PDOException $e) {
        //     echo "Erro de conexão com o banco de dados: {$e->getMessage()}";
        //     return;
        // }
        // echo '<p>FIM DO TESTE DE CONEXÃO COM O BANCO DE DADOS.</p>';

        // Retorna todos os usuários cadastrados no banco de dados.
        // $users = User::all()->toArray();
        // $userModel = new User();
        // $users = $userModel->all()->toArray();
        // echo '<pre>';
        // var_dump($users);
        // echo '</pre>';

        // Verifica se o usuário existe no banco de dados.
        $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();

        if(!$user) {
            // echo "Usuário não encontrado.";
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'O usuário não foi encontrado ou não existe.');
        }

        if(!password_verify($password, $user->password)) {
            // echo "Senha inválida.";
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'A senha informada está incorreta ou é inválida.');
        }

        // Atualiza a coluna last_login do usuário.
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // Coloca os dados do usuário na sessão.
        session([
            'user_id' => $user->id,
            'user_name' => $user->username,
            'user_last_login' => $user->last_login,
        ]);
        echo "Usuário encontrado: {$user->username}";

        echo '<pre>';
        // var_dump($user);
        echo 'Login realizado com sucesso.';
        echo '</pre>';
    }


    public function logout()
    {
        // echo "Logout: aplicação finalizada.";

        // Remove os dados do usuário da sessão.
        session()->forget(['user_id', 'user_name', 'user_last_login']);

        return redirect('/login')
            ->with('logoutSuccess', 'Você encerrou o Notes com sucesso!');
    }
}
