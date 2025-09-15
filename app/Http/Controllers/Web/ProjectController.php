<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Committee;
use App\Models\CommitteeFunction;
use App\Models\Member;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['committee', 'function'])->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $committees = Committee::all();
        $functions = CommitteeFunction::all();
        $members = Member::all();
        return view('projects.create', compact('committees', 'functions', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'committee_id' => 'required|exists:committees,id',
            'function_id' => 'nullable|exists:committee_functions,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:programado,en_ejecucion,suspendido,completado,cancelado',
            'planned_start' => 'nullable|date',
            'planned_end' => 'nullable|date',
            'duration' => 'nullable|string',
            'advance' => 'nullable|numeric|min:0|max:100'
        ]);

        $project = Project::create($validated);

        if ($request->has('responsible_ids')) {
            $project->responsibles()->attach($request->responsible_ids);
        }

        return redirect()->route('projects.index')->with('success', 'Proyecto creado exitosamente.');
    }

    public function show(Project $project)
    {
        $project->load(['committee', 'function', 'responsibles', 'tasks']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $committees = Committee::all();
        $functions = CommitteeFunction::all();
        $members = Member::all();
        $project->load(['responsibles', 'tasks']);
        return view('projects.edit', compact('project', 'committees', 'functions', 'members'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'committee_id' => 'required|exists:committees,id',
            'function_id' => 'nullable|exists:committee_functions,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:programado,en_ejecucion,suspendido,completado,cancelado',
            'planned_start' => 'nullable|date',
            'planned_end' => 'nullable|date',
            'duration' => 'nullable|string',
            'advance' => 'nullable|numeric|min:0|max:100'
        ]);

        $project->update($validated);
        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado exitosamente.');
    }
}
