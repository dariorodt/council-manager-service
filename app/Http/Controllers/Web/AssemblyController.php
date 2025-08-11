<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assembly;
use App\Models\Member;
use App\Models\Document;

class AssemblyController extends Controller
{
    public function index()
    {
        $assemblies = Assembly::all();
        return view('assemblies.index', compact('assemblies'));
    }

    public function create()
    {
        $members = Member::all();
        $documents = Document::all();
        return view('assemblies.create', compact('members', 'documents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'correlative' => 'required|string|max:255',
            'type' => 'required|in:General,Extraordinaria,De Ciudadanos,Informativa',
            'reason' => 'required|string',
            'status' => 'required|in:Programada,Finalizada',
            'scheduled_date' => 'required|date',
            'actual_date' => 'nullable|date',
        ]);

        $assembly = Assembly::create($validated);

        // Store attendees
        if ($request->has('attendees')) {
            foreach ($request->attendees as $attendee) {
                if (!empty($attendee['name'])) {
                    $assembly->attendees()->create($attendee);
                }
            }
        }

        // Store subjects
        if ($request->has('subjects')) {
            foreach ($request->subjects as $subject) {
                if (!empty($subject['title'])) {
                    $assembly->subjects()->create($subject);
                }
            }
        }

        // Store resolutions
        if ($request->has('resolutions')) {
            foreach ($request->resolutions as $resolution) {
                if (!empty($resolution['title'])) {
                    $assembly->resolutions()->create($resolution);
                }
            }
        }

        // Attach documents
        if ($request->has('document_ids')) {
            $assembly->documents()->attach($request->document_ids);
        }

        return redirect()->route('assemblies.index')->with('success', 'Assembly created successfully.');
    }

    public function show(Assembly $assembly)
    {
        $assembly->load(['attendees', 'subjects', 'resolutions', 'documents']);
        return view('assemblies.show', compact('assembly'));
    }

    public function edit(Assembly $assembly)
    {
        $members = Member::all();
        $documents = Document::all();
        $assembly->load(['attendees', 'subjects', 'resolutions', 'documents']);
        return view('assemblies.edit', compact('assembly', 'members', 'documents'));
    }

    public function update(Request $request, Assembly $assembly)
    {
        $validated = $request->validate([
            'correlative' => 'required|string|max:255',
            'type' => 'required|in:General,Extraordinaria,De Ciudadanos,Informativa',
            'reason' => 'required|string',
            'status' => 'required|in:Programada,Finalizada',
            'scheduled_date' => 'required|date',
            'actual_date' => 'nullable|date',
        ]);

        $assembly->update($validated);
        return redirect()->route('assemblies.index')->with('success', 'Assembly updated successfully.');
    }

    public function destroy(Assembly $assembly)
    {
        $assembly->delete();
        return redirect()->route('assemblies.index')->with('success', 'Assembly deleted successfully.');
    }
}
