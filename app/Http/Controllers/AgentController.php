<?php

namespace App\Http\Controllers;
use App\Models\Agent;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::with('service')->paginate(20);;
        $services = Service::withCount('agents')->get();
        $counts = [];
foreach ($services as $service) {
    $counts[$service->nom] = $service->agents_count;
}
        return view('agents.index', compact('agents', 'counts', 'services'));
    }

    public function create()
    {
        $services = Service::all();
        return view('agents.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'nombre_formation_suivi' => 'nullable|integer|min:0',
        ]);

        Agent::create($request->all());
        return redirect()->route('agents.index')
            ->with('success', 'Agent ajouté avec succès.');
    }

    public function edit(Agent $agent)
    {
        $services = Service::all();
        return view('agents.edit', compact('agent', 'services'));
    }

    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'nombre_formation_suivi' => 'nullable|integer|min:0',
        ]);

        $agent->update($request->all());
        return redirect()->route('agents.index')
            ->with('success', 'Agent mis à jour avec succès.');
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')
            ->with('success', 'Agent supprimé avec succès.');
    }
}