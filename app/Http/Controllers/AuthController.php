<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'text_username' => 'required',
            'text_password' => 'required|min:6',
        ]);

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // echo 'OK';

        // Teste de conexão com o banco de dados.
        try {
            DB::connection()->getPdo();
            echo "Conexão com o banco de dados estabelecida com sucesso.";
        } catch (\PDOException $e) {
            echo "Erro de conexão com o banco de dados: {$e->getMessage()}";
            return;
        }

        echo '<p>FIM</p>';
    }


    public function logout()
    {
        echo "Logout: aplicação finalizada.";
    }
}
