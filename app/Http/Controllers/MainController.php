<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /**
     * Exibe a página inicial.
     */
    public function index()
    {
        // Carrega as notas do usuário da sessão.

        // Retorna a view inicial com as notas.
        return view('home');
    }


    /**
     * Exibe a página de criação de notas.
     */
    public function newNote()
    {
        echo "Criando uma nova nota.";
    }

}
