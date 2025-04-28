<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Agent;
use App\Models\Module;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with(['module', 'agents'])->get();
        return view('session.index', compact('sessions'));
    }

    public function create()
    {
        $modules = Module::all();
        $agents = Agent::all();
        return view('session.create', compact('modules', 'agents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_formation' => 'required|date',
            'module_id' => 'required|exists:modules,id',
            'agent_ids' => 'required|array',
            'agent_ids.*' => 'exists:agents,id',
        ]);

        $session = Session::create([
            'date_formation' => $request->date_formation,
            'module_id' => $request->module_id,
            'nombre_agents' => count($request->agent_ids),
        ]);

        $session->agents()->attach($request->agent_ids);

        return redirect()->route('session.index')
            ->with('success', 'Session créée avec succès.');
    }

    public function edit(Session $session)
    {
        $modules = Module::all();
        $agents = Agent::all();
        $selectedAgents = $session->agents->pluck('id')->toArray();
        
        return view('session.edit', compact('session', 'modules', 'agents', 'selectedAgents'));
    }

    public function update(Request $request, Session $session)
    {
        $request->validate([
            'date_formation' => 'required|date',
            'module_id' => 'required|exists:modules,id',
            'agent_ids' => 'required|array',
            'agent_ids.*' => 'exists:agents,id',
        ]);

        $session->update([
            'date_formation' => $request->date_formation,
            'module_id' => $request->module_id,
            'nombre_agents' => count($request->agent_ids),
        ]);

        $session->agents()->sync($request->agent_ids);

        return redirect()->route('session.index')
            ->with('success', 'Session mise à jour avec succès.');
    }

    public function destroy(Session $session)
    {
        $session->agents()->detach();
        $session->delete();

        return redirect()->route('session.index')
            ->with('success', 'Session supprimée avec succès.');
    }
    
    public function addAgent(Request $request, Session $session)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
        ]);
        
        if (!$session->agents->contains($request->agent_id)) {
            $session->agents()->attach($request->agent_id);
            $session->increment('nombre_agents');
        }
        
        return redirect()->back()->with('success', 'Agent ajouté à la session.');
    }
    
    public function removeAgent(Request $request, Session $session)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
        ]);
        
        $session->agents()->detach($request->agent_id);
        $session->decrement('nombre_agents');
        
        return redirect()->back()->with('success', 'Agent retiré de la session.');
    }
}