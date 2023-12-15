<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('staff.invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $clients = Client::with('user')->where('status', Client::QUALIFIED)->get();
        $categories = Category::all();
        $admin = User::getAdmin();
        return view('staff.invoices.create', [
            'clients' => $clients,
            'categories' => $categories,
            'invoice_number' => $this->generateInvoiceNumber(),
            'admin' => $admin
        ]);
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
        //
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

    public function generateInvoiceNumber() {
        // Get current timestamp
        $timestamp = now()->timestamp;

        // Generate a random number between 100000 and 999999
        $randomNumber = mt_rand(100, 999);

        // Combine timestamp and random number
        $invoiceNumber = $timestamp . $randomNumber;

        // Take the last 6 digits to ensure it's a 6-digit number
        $invoiceNumber = substr($invoiceNumber, -6);

        return $invoiceNumber;
    }
}
