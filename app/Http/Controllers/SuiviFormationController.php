<?php

namespace App\Http\Controllers;

use App\Models\SuiviFormation;
use App\Models\Session;
use App\Models\Agent;
use App\Models\Module;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * @property string $statut
 */
class SuiviFormationController extends Controller
{
    public function index(Request $request)
    {
        // Cette méthode va générer automatiquement les suivis basés sur les sessions et agents
        $this->generateSuiviFormation();
        
        // Initialiser la requête avec les relations
        $query = SuiviFormation::with(['session.module', 'agent.service']);
        
        // Filtre par agent
        if ($request->filled('agent')) {
            $query->whereHas('agent', function ($q) use ($request) {
                $q->where('prenom', 'like', '%' . $request->agent . '%')
                  ->orWhere('nom', 'like', '%' . $request->agent . '%');
            });
        }
        
        // Filtre par module
        if ($request->filled('module')) {
            $query->whereHas('session.module', function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->module . '%');
            });
        }
        
        // Filtre par service
        if ($request->filled('service')) {
            $query->whereHas('agent.service', function ($q) use ($request) {
                $q->where('id', $request->service);
            });
        }
        
        // Récupérer les suivis filtrés
        $suivis = $query->get();
        
        // Récupérer tous les services pour le filtre déroulant
        $services = Service::orderBy('nom')->get();
        
        return view('suivi-formation.index', compact('suivis', 'services'));
    }
    
    // Cette méthode génère automatiquement les entrées de suivi de formation
    // basées sur les sessions et les agents inscrits
    private function generateSuiviFormation()
    {
        // Récupérer toutes les sessions avec leurs agents
        $sessions = Session::with('agents')->get();
        
        foreach ($sessions as $session) {
            foreach ($session->agents as $agent) {
                // Vérifier si un suivi existe déjà pour cette session et cet agent
                $suivi = SuiviFormation::where('session_id', $session->id)
                    ->where('agent_id', $agent->id)
                    ->first();
                
                // Si le suivi n'existe pas, le créer
                if (!$suivi) {
                    $statut = Carbon::parse($session->date_formation)->isPast() ? 'TERMINÉE' : 'INSCRIT';
                    
                    SuiviFormation::create([
                        'session_id' => $session->id,
                        'agent_id' => $agent->id,
                        'statut' => $statut
                    ]);
                } else {
                    // Mettre à jour le statut si nécessaire
                    $statut = Carbon::parse($session->date_formation)->isPast() ? 'TERMINÉE' : 'INSCRIT';
                    
                    if ($suivi->statut !== $statut) {
                        $suivi->statut = $statut;
                        $suivi->save();
                    }
                }
            }
        }
    }
    
    // Cette méthode devrait être exécutée quotidiennement via une tâche planifiée
    // pour mettre à jour automatiquement les statuts
    public function updateStatuts()
    {
        // Récupérer tous les suivis avec leur session
        $suivis = SuiviFormation::with('session')->get();
        
        foreach ($suivis as $suivi) {
            // Vérifier si des champs importants sont vides
            if (empty($suivi->titre_module) || $suivi->titre_module == '-----' || empty($suivi->agent)) {
                // Supprimer les lignes avec des champs vides
                $suivi->delete();
                continue; // Passer à l'itération suivante
            }
            
            // Mettre à jour le statut si nécessaire (code existant)
            if ($suivi->statut == 'INSCRIT' && Carbon::parse($suivi->session->date_formation)->lt(Carbon::now())) {
                $suivi->statut = 'TERMINÉE';
                $suivi->save();
            }
        }
        
        return redirect()->route('suivi-formation.index')
            ->with('success', 'Statuts mis à jour et lignes vides supprimées avec succès.');
    }
}