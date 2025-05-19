<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonthController extends Controller
{
    public function create()
{
    return view('months.create'); // Formulaire de sélection de mois/année
}

public function store(Request $request)
{
    $request->validate([
        'month' => 'required|integer|min:1|max:12',
        'year' => 'required|integer|min:2000',
    ]);

    // Créer une nouvelle colonne logique ou un suivi de mois via une relation
    // À adapter selon ton modèle (MonthlyLeave par ex.)
    
    return redirect()->route('employees.index', ['month' => $request->month, 'year' => $request->year])
                     ->with('success', 'Mois ajouté avec succès');
}

}
