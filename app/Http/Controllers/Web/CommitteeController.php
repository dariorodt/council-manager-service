<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Committee;
use App\Models\Member;
use App\Models\Document;

class CommitteeController extends Controller
{
    public function index()
    {
        $committees = Committee::with('responsible')->get();
        return view('committees.index', compact('committees'));
    }

    public function create()
    {
        $members = Member::all();
        $documents = Document::all();
        return view('committees.create', compact('members', 'documents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'responsible_id' => 'nullable|exists:members,id',
            'status' => 'required|in:Creado,En Funciones,Suspendido',
            'creation_date' => 'required|date'
        ]);

        $committee = Committee::create($validated);

        if ($request->has('member_ids')) {
            $committee->members()->attach($request->member_ids);
        }

        if ($request->has('document_ids')) {
            $committee->documents()->attach($request->document_ids);
        }

        return redirect()->route('committees.index')->with('success', 'Comité creado exitosamente.');
    }

    public function show(Committee $committee)
    {
        $committee->load(['responsible', 'functions', 'members', 'documents']);
        return view('committees.show', compact('committee'));
    }

    public function edit(Committee $committee)
    {
        $members = Member::all();
        $documents = Document::all();
        $committee->load(['members', 'documents', 'functions']);
        return view('committees.edit', compact('committee', 'members', 'documents'));
    }

    public function update(Request $request, Committee $committee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'responsible_id' => 'nullable|exists:members,id',
            'status' => 'required|in:Creado,En Funciones,Suspendido',
            'creation_date' => 'required|date'
        ]);

        $committee->update($validated);

        // Handle functions
        if ($request->has('functions')) {
            foreach ($request->functions as $functionData) {
                if (!empty($functionData['nombre'])) {
                    if (isset($functionData['id'])) {
                        // Update existing function
                        $committee->functions()->where('id', $functionData['id'])->update([
                            'nombre' => $functionData['nombre'],
                            'descripcion' => $functionData['descripcion'],
                            'ref_act' => $functionData['ref_act'],
                        ]);
                    } else {
                        // Create new function
                        $committee->functions()->create([
                            'nombre' => $functionData['nombre'],
                            'descripcion' => $functionData['descripcion'],
                            'ref_act' => $functionData['ref_act'],
                        ]);
                    }
                }
            }
        }

        return redirect()->route('committees.index')->with('success', 'Comité actualizado exitosamente.');
    }

    public function destroy(Committee $committee)
    {
        $committee->delete();
        return redirect()->route('committees.index')->with('success', 'Comité eliminado exitosamente.');
    }
}
