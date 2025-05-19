<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Agent;
use App\Models\LeaveRecord;
use App\Models\MonthlyLeave;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees with leave information.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Récupération des filtres
        $search = $request->input('search');
        $currentMonth = $request->get('month', date('n'));
        $currentYear = $request->get('year', date('Y'));
        $displayMonth = $currentMonth;
        $monthKey = sprintf("%02d/%d", $displayMonth, $currentYear);
    
        // Construction de la requête des employés avec leurs relations
        $employeesQuery = Employee::with(['monthlyLeaves', 'leaveRecord']);
    
        // Application du filtre de recherche (nom ou prénom)
        if ($search) {
            $employeesQuery->where(function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%");
            });
        }
    
        // Exécution de la requête
        $employees = $employeesQuery->get();
    
        // Calcul des valeurs pour chaque employé
        $employees->each(function ($employee) use ($monthKey) {
            $employee->conges_acquis_value = $employee->conges_acquis;
            $employee->conges_restants_value = $employee->getCongesRestantsForMonth($monthKey);
            $employee->anciennete_value = $employee->anciennete;
        });
    
        // Liste des mois pour l'affichage dans le dropdown
        $availableMonths = [
            '1' => 'Janvier', '2' => 'Février', '3' => 'Mars', '4' => 'Avril',
            '5' => 'Mai', '6' => 'Juin', '7' => 'Juillet', '8' => 'Août',
            '9' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre'
        ];
    
        // Retour de la vue
        return view('employees.index', [
            'employees' => $employees,
            'availableMonths' => $availableMonths,
            'displayMonth' => $displayMonth,
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth,
        ]);
    }
    

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all(); // ou la méthode appropriée pour récupérer vos agents
        return view('employees.create', compact('agents'));
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:agents,id',
            'date_embauche' => 'required|date',
        ]);
    
        // Récupérer l'agent sélectionné
        $agent = Agent::findOrFail($request->agent_id);
        
        // Créer un nouvel employé avec les données de l'agent
        $employee = new Employee();
        $employee->nom = $agent->nom;
        $employee->prenom = $agent->prenom;
        $employee->date_embauche = $request->date_embauche;
        // Définir d'autres champs par défaut si nécessaire
        $employee->save();
        

        // Create initial leave record with 0 taken leave
        LeaveRecord::create([
            'employee_id' => $employee->id,
            'conges_pris' => 0,
        ]);

        return redirect()->route('employees.index')
            ->with('success', 'Employé ajouté avec succès');
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, Employee $employee)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_embauche' => 'required|date',
        'conges_pris' => 'required|numeric|min:0',
        'monthly_leaves.*' => 'nullable|numeric|min:0',
    ]);

    $employee->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'date_embauche' => $request->date_embauche,
    ]);

    // Update leave record
    $leaveRecord = $employee->leaveRecord;
    if (!$leaveRecord) {
        $leaveRecord = new LeaveRecord(['employee_id' => $employee->id]);
    }
    $leaveRecord->conges_pris = $request->conges_pris;
    $leaveRecord->save();

    // Update monthly leaves if provided
    if ($request->has('monthly_leaves')) {
        foreach ($request->monthly_leaves as $month => $value) {
            // Assurez-vous que la valeur est un nombre
            if (is_numeric($value)) {
                MonthlyLeave::updateOrCreate(
                    ['employee_id' => $employee->id, 'month_key' => $month],
                    ['leave_value' => $value]
                );
            }
        }
    }

    return redirect()->route('employees.index')
        ->with('success', 'Employé mis à jour avec succès');
}

    /**
     * Remove the specified employee from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employé supprimé avec succès');
    }

    /**
     * Add a new month column to track leave.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addMonthColumn(Request $request)
    {
        $request->validate([
            'new_month' => 'required|string|regex:/^(0[1-9]|1[0-2])\/20[0-9]{2}$/',
        ]);

        $newMonth = $request->new_month;
        
        // Check if this month already exists
        $exists = MonthlyLeave::where('month_key', $newMonth)->exists();
        
        if (!$exists) {
            // Add this month for all employees with default 0 value
            $employees = Employee::all();
            foreach ($employees as $employee) {
                MonthlyLeave::create([
                    'employee_id' => $employee->id,
                    'month_key' => $newMonth,
                    'leave_value' => 0,
                ]);
            }
        }

        return redirect()->route('employees.index', ['month' => $newMonth])
            ->with('success', 'Nouvelle colonne ajoutée pour le mois ' . $newMonth);
    }
    public function editMonthlyLeave(Employee $employee, $month, $year)
{
    // Récupérer l'enregistrement mensuel s'il existe
    $monthlyLeave = MonthlyLeave::where('employee_id', $employee->id)
                    ->where('month', $month)
                    ->where('year', $year)
                    ->first();
                    
    // S'il n'existe pas, créer un nouveau
    if (!$monthlyLeave) {
        $monthlyLeave = new MonthlyLeave([
            'employee_id' => $employee->id,
            'month' => $month,
            'year' => $year,
            'days_taken' => 0
        ]);
    }
    
    return view('employees.edit_monthly_leave', compact('employee', 'monthlyLeave', 'month', 'year'));
}
public function updateMonthlyLeave(Request $request, Employee $employee)
{
    $request->validate([
        'month' => 'required|integer|between:1,12',
        'year' => 'required|integer|min:2000',
        'days_taken' => 'required|numeric|min:0'
    ]);
    
    // Trouver ou créer l'enregistrement mensuel
    $monthlyLeave = MonthlyLeave::firstOrNew([
        'employee_id' => $employee->id,
        'month' => $request->month,
        'year' => $request->year
    ]);
    
    $monthlyLeave->days_taken = $request->days_taken;
    $monthlyLeave->save();
    
    // Mettre à jour le total des congés pris
    $totalLeaves = $employee->monthlyLeaves->sum('days_taken');
    
    // Mise à jour de l'enregistrement principal des congés
    $leaveRecord = $employee->leaveRecord;
    if (!$leaveRecord) {
        $leaveRecord = new LeaveRecord(['employee_id' => $employee->id]);
    }
    $leaveRecord->conges_pris = $totalLeaves;
    $leaveRecord->save();
    
    return redirect()->route('employees.index', ['month' => $request->month, 'year' => $request->year])
        ->with('success', 'Congés mensuels mis à jour avec succès');
}

    
}