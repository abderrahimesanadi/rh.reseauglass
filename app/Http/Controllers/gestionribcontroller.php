<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\AgentRib;
use Illuminate\Support\Facades\DB;
use App\Models\Service;

class GestionRibController extends Controller
{
    /**
     * Affiche la page de liste des RIB
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = AgentRib::with('agent');
        
        // Ajout de la recherche si elle existe
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('agent', function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%");
            });
        }
        
        $agentRibs = $query->get();
        
        return view('gestion-rib.index', compact('agentRibs'));
    }
    /**
     * Affiche le formulaire de création d'un RIB
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $services = Service::all();
        $agents = Agent::orderBy('nom')->orderBy('prenom')->get();
        
        return view('gestion-rib.create', compact('agents', 'services'));
    }

    /**
     * Enregistre un nouveau RIB
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation des champs communs
        $request->validate([
            'rib' => 'required|string',
            'status' => 'required|string',
        ]);

        // Vérification de l'option choisie
        $agentOption = $request->input('agent_option', 'existing');
        
        if ($agentOption === 'existing') {
            // Pour un agent existant
            $request->validate([
                'agent_id' => 'required|exists:agents,id',
            ], [
                'agent_id.required' => 'Le champ agent est obligatoire.'
            ]);
            
            $agentId = $request->agent_id;
        } else {
            // Pour un nouvel agent
            $request->validate([
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'service_id' => 'required|exists:services,id',
            ]);
            
            // Création du nouvel agent
            $agent = Agent::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'service_id' => $request->service_id,
            ]);
            
            $agentId = $agent->id;
        }

        // Création du RIB
        AgentRib::create([
            'agent_id' => $agentId,
            'rib' => $request->rib,
            'status' => $request->status,
        ]);

        return redirect()->route('gestion-rib.index')
            ->with('success', 'RIB ajouté avec succès.');
    }

    /**
     * Met à jour un RIB
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rib' => 'required|string|min:10|max:30',
            'status' => 'required|in:new,new rib',
        ]);

        $agentRib = AgentRib::findOrFail($id);
        $agentRib->update([
            'rib' => $request->rib,
            'status' => $request->status,
        ]);

        return redirect()->route('gestion-rib.index')
            ->with('success', 'RIB mis à jour avec succès');
    }

    /**
     * Supprime un RIB
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $agentRib = AgentRib::findOrFail($id);
        $agentRib->delete();

        return redirect()->route('gestion-rib.index')
            ->with('success', 'RIB supprimé avec succès');
    }
}