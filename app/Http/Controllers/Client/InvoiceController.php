<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $invoices = Invoice::with(['items', 'category'])
            ->where('client_id', Auth::user()->userable->id)
            ->where('sent', 1)
            ->where('status', '!=', Invoice::DRAFT)
            ->get();
        return view('clients.invoices.index', [
            'invoices' => $invoices,
            'status_labels' => Invoice::getStatusLabels()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $invoice = Invoice::with(['items', 'category', 'client'])
            ->where('client_id', Auth::user()->userable->id)
            ->where('sent', 1)
            ->where('status', '!=', Invoice::DRAFT)
            ->findOrFail($id);

        $this->authorize('client.invoices', $invoice);

        return view('clients.invoices.show', [
            'invoice' => $invoice,
        ]);
    }

    public function bank(Request $request, string $id) {
        $bank = $request->query('bankDetails');

        $bank = json_decode($bank);

        return view('clients.invoices.bank', [
            'bank' => $bank
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
