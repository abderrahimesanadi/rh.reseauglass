<?php

namespace App\Http\Controllers;

use App\Models\CongeAgent;
use App\Models\Agent;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SuiviCongeController extends Controller
{
    /**
     * Affiche la page de suivi des congés
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $serviceFilter = $request->input('service');
        
        try {
            // Obtenir le mois et l'année
            $monthYear = $request->input('month_year');
            $currentDate = $monthYear ? Carbon::createFromFormat('Y-m', $monthYear) : Carbon::now();
            $month = $currentDate->month;
            $year = $currentDate->year;
    
            // Requête des agents avec jointure service
            $agentsQuery = DB::table('agents')
                ->join('services', 'agents.service_id', '=', 'services.id')
                ->select(
                    'agents.id as agent_id', 
                    'services.nom as service', 
                    'agents.nom', 
                    'agents.prenom'
                )
                ->orderBy('services.nom')
                ->orderBy('agents.nom');
    
            if ($search) {
                $agentsQuery->where(function($query) use ($search) {
                    $query->where('agents.nom', 'like', "%{$search}%")
                          ->orWhere('agents.prenom', 'like', "%{$search}%");
                });
            }
    
            if ($serviceFilter) {
                $agentsQuery->where('services.nom', $serviceFilter);
            }
    
            $agents = $agentsQuery->get();
    
            if ($agents->isEmpty()) {
                $agents = CongeAgent::select('agent_id', 'service', 'nom', 'prenom')
                    ->distinct('agent_id')
                    ->orderBy('service')
                    ->orderBy('nom')
                    ->get();
            }
    
            Log::info('Nombre d\'agents récupérés: ' . $agents->count());
    
            // Préparer les jours du mois
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $days = [];
    
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = Carbon::createFromDate($year, $month, $i);
                $days[] = [
                    'date' => $date->format('Y-m-d'),
                    'day' => $date->format('d'),
                    'dayName' => mb_strtoupper($date->locale('fr')->dayName),
                    'is_weekend' => $date->isWeekend(),
                ];
            }
    
            // Récupérer tous les congés groupés par agent
            $conges = CongeAgent::whereMonth('date_suivi', $month)
                ->whereYear('date_suivi', $year)
                ->get()
                ->groupBy('agent_id');
    
            // Calculer les totaux CP (C)
            $cpTotals = [];
            foreach ($agents as $agent) {
                $cpTotals[$agent->agent_id] = CongeAgent::where('agent_id', $agent->agent_id)
                    ->whereMonth('date_suivi', $month)
                    ->whereYear('date_suivi', $year)
                    ->where('status', 'C')
                    ->count();
            }
    
            // Calculer les totaux Maladie (M) et Absence (A)
            $maladeTotals = [];
            $absentTotals = [];
    
            foreach ($agents as $agent) {
                $maladeTotals[$agent->agent_id] = CongeAgent::where('agent_id', $agent->agent_id)
                    ->whereMonth('date_suivi', $month)
                    ->whereYear('date_suivi', $year)
                    ->where('status', 'M')
                    ->count();
    
                $absentTotals[$agent->agent_id] = CongeAgent::where('agent_id', $agent->agent_id)
                    ->whereMonth('date_suivi', $month)
                    ->whereYear('date_suivi', $year)
                    ->where('status', 'A')
                    ->count();
            }
    
            // Récupérer les services (pour filtre/couleur)
            $services = Service::all();
    
            return view('suivi-conge.index', compact(
                'days', 
                'agents', 
                'conges', 
                'cpTotals', 
                'maladeTotals', 
                'absentTotals', 
                'currentDate', 
                'month', 
                'year',
                'services',
                'search', 
                'serviceFilter'
            ));
    
        } catch (\Exception $e) {
            Log::error('Erreur dans index: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors du chargement des données: ' . $e->getMessage());
        }
    }
    
    /**
     * Enregistrer un nouveau congé
     */
    public function store(Request $request)
    {
        try {
            // Validation des données
            $validated = $request->validate([
                'agent_id' => 'required',
                'date' => 'required|date',
                'status' => 'required|in:C,A,M',
            ]);
    
            $date = Carbon::parse($validated['date']);
    
            // Récupérer les infos de l'agent
            $agentInfo = DB::table('agents')
                ->join('services', 'agents.service_id', '=', 'services.id')
                ->where('agents.id', $validated['agent_id'])
                ->select(
                    'agents.id as agent_id',
                    'services.nom as service',
                    'agents.nom',
                    'agents.prenom'
                )
                ->first();
    
            if (!$agentInfo) {
                return back()->with('error', 'Agent introuvable');
            }
    
            // Créer ou mettre à jour le congé
            CongeAgent::updateOrCreate(
                [
                    'agent_id' => $agentInfo->agent_id,
                    'date_suivi' => $date->format('Y-m-d')
                ],
                [
                    'service' => $agentInfo->service,
                    'nom' => $agentInfo->nom,
                    'prenom' => $agentInfo->prenom,
                    'jour_type' => mb_strtoupper($date->locale('fr')->dayName),
                    'status' => $validated['status']
                ]
            );
    
            return back()->with('success', 'Congé enregistré avec succès');
    
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'enregistrement: '.$e->getMessage());
            return back()->with('error', 'Erreur: '.$e->getMessage());
        }
    }
    
    /**
     * Supprimer un congé
     */
    public function destroy(Request $request)
    {
        try {
            $validated = $request->validate([
                'agent_id' => 'required|integer',
                'date' => 'required|date_format:Y-m-d', // Format explicite
            ]);
            
            $deleted = CongeAgent::where('agent_id', $validated['agent_id'])
                ->whereDate('date_suivi', $validated['date']) // whereDate pour ignorer l'heure
                ->delete();
            
            return redirect()->back()->with(
                $deleted ? 'success' : 'info',
                $deleted ? 'Congé supprimé avec succès' : 'Aucun congé trouvé à supprimer'
            );
            
        } catch (\Exception $e) {
            Log::error('Erreur suppression congé: ' . $e->getMessage());
            return back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }
    
    /**
     * API pour récupérer la liste des agents
     */
    public function getAgents()
    {
        try {
            // Récupérer les agents depuis la table agents avec jointure services
            $agents = DB::table('agents')
                ->join('services', 'agents.service_id', '=', 'services.id')
                ->select(
                    'agents.id as agent_id', 
                    'services.nom as service', 
                    'agents.nom', 
                    'agents.prenom'
                )
                ->orderBy('services.nom')
                ->orderBy('agents.nom')
                ->get();
            
            return response()->json($agents);
        } catch (\Exception $e) {
            Log::error('Erreur dans getAgents: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Générer un rapport de congés
     */
    public function report(Request $request)
    {
        // À implémenter
        return redirect()->back()->with('info', 'Fonction de rapport à implémenter');
}
}