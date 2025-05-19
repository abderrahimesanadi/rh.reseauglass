<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Module;
use App\Models\SuiviQualite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Session;


class SuiviQualiteController extends Controller
{
    public function index(Request $request)
    {
        $query = SuiviQualite::with(['agent', 'session', 'suiviQualite']);
        
        // Si une recherche par agent est effectuée
        if ($request->has('agent_search') && $request->agent_search != '') {
            $agentSearch = $request->agent_search;
            $query->whereHas('agent', function($q) use ($agentSearch) {
                $q->where('nom', 'like', '%' . $agentSearch . '%')
                  ->orWhere('prenom', 'like', '%' . $agentSearch . '%');
            });
        }
        
        $suiviqualite = $query->get();
        
        return view('suivi-qualite.index', compact('suiviqualite'));
    }

    public function create()
    {
        $agents = Agent::orderBy('nom')->orderBy('prenom')->get();
        $modules = Module::all();
        $users = User::where('role', 'responsable')->get(); // For suivi qualité dropdown
        return view('suivi-qualite.create', compact('agents', 'modules', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'module_id' => 'required|exists:modules,id',
            'analyse' => 'nullable|in:Conforme,Passable,Non conforme',
            'suivi_qualite_id' => 'nullable|exists:users,id',
            'numero_dossier' => 'nullable|string',
            'date_traitement_dossier' => 'nullable|date',
            'commentaire' => 'nullable|string',
        ]);
        if (empty($request->agent_id) && !empty($request->agent_nom_prenom)) {
            // Créer le nouvel agent et récupérer son ID
            $nomPrenom = explode(' ', $request->agent_nom_prenom, 2);
            $nom = $nomPrenom[0] ?? '';
            $prenom = $nomPrenom[1] ?? '';
            
            $agent = Agent::create([
                'nom' => $nom,
                'prenom' => $prenom,
                // autres champs nécessaires
            ]);
            
            $request->merge(['agent_id' => $agent->id]);
        }
        if (empty($request->module_id) && !empty($request->module_titre)) {
            $module = Module::create([
                'titre' => $request->module_titre,
                // autres champs nécessaires
            ]);
            
            $request->merge(['module_id' => $module->id]);
        }
        // Get the session date from the selected session
        $session = \App\Models\Session::where('module_id', $request->module_id)->first();
        $validated['date_fin_formation'] = $session ? $session->date_formation : null;

        Suiviqualite::create($validated);

        return redirect()->route('suivi-qualite.index')
                        ->with('success', 'Suivi de qualité ajouté avec succès.');
    }

    public function edit(Request $request, SuiviQualite $suivi_qualite)
    {
        $agents = Agent::all();
        $modules = Module::all();
        $users = User::where('role', 'responsable')->get();
        $suiviqualite = $suivi_qualite;

        return view('suivi-qualite.edit', compact('suiviqualite', 'agents', 'modules', 'users'));
    }

    public function update(Request $request, SuiviQualite $suivi_qualite)
    {
        $validated = $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'module_id' => 'required|exists:modules,id',
            'analyse' => 'nullable|in:Conforme,Passable,Non conforme',
            'suivi_qualite_id' => 'nullable|exists:users,id',
            'numero_dossier' => 'nullable|string',
            'date_traitement_dossier' => 'nullable|date',
            'commentaire' => 'nullable|string',
        ]);

        // Update date_fin_formation if session changed
        if ($request->module_id != $suivi_qualite->module_id) {
            $session = \App\Models\Session::where('module_id', $request->module_id)->first();
            $validated['date_fin_formation'] = $session ? $session->date_formation : null;
        }

        $suivi_qualite->update($validated);

        return redirect()->route('suivi-qualite.index')
                        ->with('success', 'Suivi qualité mis à jour avec succès.');
                        
    }

    public function destroy(Suiviqualite $suivi_qualite)
    {
        $suivi_qualite->delete();
        return redirect()->route('suivi-qualite.index')
                        ->with('success', 'Suivi qualité supprimé avec succès.');
    }
    
}