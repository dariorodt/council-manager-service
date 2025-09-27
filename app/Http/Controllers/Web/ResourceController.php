<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:material,personal,transporte,imprevistos',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:0',
            'unity' => 'required|in:kg,m,m2,m3,lt,hrs,dias,unidad,paquete,caja',
            'unity_cost' => 'nullable|numeric|min:0',
            'total_cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:planificado,en_stock,consumido'
        ]);

        Resource::create($validated);
        return response()->json(['success' => true]);
    }

    public function edit(Resource $resource)
    {
        return response()->json($resource);
    }

    public function update(Request $request, Resource $resource)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'name' => 'required|string|max:255',
            'type' => 'required|in:material,personal,transporte,imprevistos',
            'description' => 'nullable|string',
            'quantity' => 'required|numeric|min:0',
            'unity' => 'required|in:kg,m,m2,m3,lt,hrs,dias,unidad,paquete,caja',
            'unity_cost' => 'nullable|numeric|min:0',
            'total_cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:planificado,en_stock,consumido'
        ]);

        $resource->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy(Resource $resource)
    {
        $resource->delete();
        return redirect()->back()->with('success', 'Recurso eliminado exitosamente.');
    }
}
