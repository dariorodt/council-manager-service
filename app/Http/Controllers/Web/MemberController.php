<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    // List all members
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    // Show form to create a new member
    public function create()
    {
        return view('members.create');
    }

    // Store a new member
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:255',
            'nacimiento' => 'required|date',
            'correo' => 'required|email|unique:members,email',
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'unidad' => 'required|string|max:255',
            'inicio_mandato' => 'required|date',
            'fin_mandato' => 'required|date|after:inicio_mandato',
        ]);

        Member::create([
            'name' => $validated['nombre'],
            'id_document' => $validated['cedula'],
            'date_of_birth' => $validated['nacimiento'],
            'email' => $validated['correo'],
            'phone' => $validated['telefono'],
            'address' => $validated['direccion'],
            'unit' => $validated['unidad'],
            'membership_start_date' => $validated['inicio_mandato'],
            'membership_end_date' => $validated['fin_mandato'],
            'status' => 'active',
        ]);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    // Show a single member
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    // Show form to edit a member
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    // Update a member
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:255',
            'nacimiento' => 'required|date',
            'correo' => 'required|email|unique:members,email,' . $member->id,
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'unidad' => 'required|string|max:255',
            'inicio_mandato' => 'required|date',
            'fin_mandato' => 'required|date|after:inicio_mandato',
        ]);

        $member->update([
            'name' => $validated['nombre'],
            'id_document' => $validated['cedula'],
            'date_of_birth' => $validated['nacimiento'],
            'email' => $validated['correo'],
            'phone' => $validated['telefono'],
            'address' => $validated['direccion'],
            'unit' => $validated['unidad'],
            'membership_start_date' => $validated['inicio_mandato'],
            'membership_end_date' => $validated['fin_mandato'],
        ]);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    // Delete a member
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}