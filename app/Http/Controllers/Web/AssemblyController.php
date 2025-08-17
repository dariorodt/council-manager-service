<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assembly;
use App\Models\Member;
use App\Models\Document;
use Illuminate\Support\Str;

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

    public function dashboard(Request $request)
    {
        $period = $request->get('period', 12);
        $type = $request->get('type');
        
        // Calculate average attendees (only completed assemblies)
        $assemblies = Assembly::with('attendees')->where('status', 'Finalizada')->get();
        $avgAttendees = $assemblies->avg(function($assembly) {
            return $assembly->attendees->where('attended', 1)->count();
        });
        
        // Last assembly attendees (only completed)
        $lastAssembly = Assembly::with('attendees')->where('status', 'Finalizada')->latest('scheduled_date')->first();
        $lastAttendees = $lastAssembly ? $lastAssembly->attendees->where('attended', 1)->count() : 0;
        
        // Previous assembly for comparison (only completed)
        $prevAssembly = Assembly::with('attendees')->where('status', 'Finalizada')->where('id', '!=', $lastAssembly?->id)->latest('scheduled_date')->first();
        $prevAttendees = $prevAssembly ? $prevAssembly->attendees->where('attended', 1)->count() : 0;
        
        // Calculate variations
        $avgVariation = $prevAttendees > 0 ? (($avgAttendees - $prevAttendees) / $prevAttendees) * 100 : 0;
        $lastVariation = $prevAttendees > 0 ? (($lastAttendees - $prevAttendees) / $prevAttendees) * 100 : 0;
        
        // Chart data (only completed assemblies)
        $chartQuery = Assembly::with('attendees')
            ->where('status', 'Finalizada')
            ->where('scheduled_date', '>=', now()->subMonths($period))
            ->orderBy('scheduled_date');
            
        if ($type) {
            $chartQuery->where('type', $type);
        }
        
        $chartAssemblies = $chartQuery->get();
        $chartData = [
            'labels' => $chartAssemblies->map(fn($a) => $a->scheduled_date->format('M Y'))->toArray(),
            'attendees' => $chartAssemblies->map(fn($a) => $a->attendees->where('attended', 1)->count())->toArray(),
            'average' => array_fill(0, $chartAssemblies->count(), $avgAttendees)
        ];
        
        // Upcoming assemblies
        $upcomingAssemblies = Assembly::where('scheduled_date', '>', now())
            ->where('status', 'Programada')
            ->orderBy('scheduled_date')
            ->limit(5)
            ->get();
            
        // Recent resolutions
        $recentResolutions = \App\Models\Resolution::with('assembly')
            ->latest()
            ->limit(5)
            ->get();
        
        if ($request->get('ajax')) {
            return response()->json(compact('chartData'));
        }
        
        return view('assemblies.dashboard', compact(
            'avgAttendees', 'avgVariation', 'lastAttendees', 'lastVariation',
            'chartData', 'upcomingAssemblies', 'recentResolutions'
        ));
    }
}
