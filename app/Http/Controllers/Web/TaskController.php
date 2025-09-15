<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:programada,en_ejecucion,suspendida',
            'planned_start' => 'nullable|date',
            'planned_end' => 'nullable|date',
            'duration' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'advance' => 'nullable|numeric|min:0|max:100'
        ]);

        Task::create($validated);
        return response()->json(['success' => true]);
    }

    public function edit(Task $task)
    {
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:programada,en_ejecucion,suspendida',
            'planned_start' => 'nullable|date',
            'planned_end' => 'nullable|date',
            'duration' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'advance' => 'nullable|numeric|min:0|max:100'
        ]);

        $task->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Tarea eliminada exitosamente.');
    }
}
