<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'number' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'description' => 'nullable|string',
            'provider' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'document_id' => 'nullable|exists:documents,id'
        ]);

        Invoice::create($validated);
        return response()->json(['success' => true]);
    }

    public function edit(Invoice $invoice)
    {
        return response()->json($invoice);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'number' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'description' => 'nullable|string',
            'provider' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'document_id' => 'nullable|exists:documents,id'
        ]);

        $invoice->update($validated);
        return response()->json(['success' => true]);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->back()->with('success', 'Factura eliminada exitosamente.');
    }
}
