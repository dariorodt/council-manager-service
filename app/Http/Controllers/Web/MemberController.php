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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
        ]);

        Member::create($validated);

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    // Delete a member
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}