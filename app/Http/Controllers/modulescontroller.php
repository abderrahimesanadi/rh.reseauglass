<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Service;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        $services = Service::all();
        return view('modules.index', compact('modules', 'services'));
    }

    public function create()
    {
        $services = Service::all();
        return view('modules.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'services' => 'required|array',
            'services.*' => 'required|string',
            'titre' => 'required',
            'competences' => 'nullable',
            'objectifs' => 'nullable',
        ]);
        
        // Créer le module sans le service (car maintenant c'est un tableau)
        $module = Module::create([
            'titre' => $request->titre,
            'competences' => $request->competences,
            'objectifs' => $request->objectifs,
            'service' => implode(', ', $request->services) // On concatène les services avec une virgule
        ]);
        
        return redirect()->route('modules.index')
            ->with('success', 'Module ajouté avec succès.');
    }

    public function edit(Module $module)
    {
        $services = Service::all();
        return view('modules.edit', compact('module', 'services'));
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            'service' => 'required',
            'titre' => 'required',
            'competences' => 'nullable',
            'objectifs' => 'nullable',
        ]);

        $module->update($request->all());
        return redirect()->route('modules.index')
            ->with('success', 'Module mis à jour avec succès.');
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index')
            ->with('success', 'Module supprimé avec succès.');
    }
}