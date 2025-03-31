<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        echo "Homepage";
    }


    public function newNote() {
        echo "Criando uma nova nota.";
    }
}
