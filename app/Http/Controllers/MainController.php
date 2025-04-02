<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        echo "Homepage";
    }


    public function newNote()
    {
        echo "Criando uma nova nota.";
    }


    public function teste()
    {
        echo 'Teste de acesso à rota /teste.';
    }
}
