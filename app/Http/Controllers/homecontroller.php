<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home');
    }
}