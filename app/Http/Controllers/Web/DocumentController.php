<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'extension' => 'required|string|max:10',
            'description' => 'nullable|string',
            'transcription' => 'nullable|string',
            'url' => 'required|string|max:500',
        ]);

        Document::create([
            'name' => $validated['name'],
            'extension' => $validated['extension'],
            'description' => $validated['description'],
            'transcription' => $validated['transcription'],
            'url' => $validated['url'],
            'created_by' => 1, // TODO: Replace with auth()->id()
            'updated_by' => 1, // TODO: Replace with auth()->id()
        ]);

        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'extension' => 'required|string|max:10',
            'description' => 'nullable|string',
            'transcription' => 'nullable|string',
            'url' => 'required|string|max:500',
        ]);

        $document->update([
            'name' => $validated['name'],
            'extension' => $validated['extension'],
            'description' => $validated['description'],
            'transcription' => $validated['transcription'],
            'url' => $validated['url'],
            'updated_by' => 1, // TODO: Replace with auth()->id()
        ]);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');
        
        return response()->json([
            'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'extension' => $file->getClientOriginalExtension(),
            'url' => Storage::url($path)
        ]);
    }
}
