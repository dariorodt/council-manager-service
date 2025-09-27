<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Milestone;

class MilestoneController extends Controller
{
    public function store(Request $request)
    {
        $project = \App\Models\Project::findOrFail($request->project_id);
        
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => [
                'required',
                'date',
                'after_or_equal:' . ($project->planned_start ? $project->planned_start->format('Y-m-d') : 'today'),
                'before_or_equal:' . ($project->planned_end ? $project->planned_end->format('Y-m-d') : '2099-12-31')
            ]
        ]);

        Milestone::create($validated);
        return response()->json(['success' => true]);
    }

    public function edit(Milestone $milestone)
    {
        return response()->json($milestone);
    }

    public function update(Request $request, Milestone $milestone)
    {
        $project = $milestone->project;
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => [
                'required',
                'date',
                'after_or_equal:' . ($project->planned_start ? $project->planned_start->format('Y-m-d') : 'today'),
                'before_or_equal:' . ($project->planned_end ? $project->planned_end->format('Y-m-d') : '2099-12-31')
            ]
        ]);

        $milestone->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return redirect()->back()->with('success', 'Hito eliminado exitosamente.');
    }
}
