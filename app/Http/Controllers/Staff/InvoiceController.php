<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceStatusUpdated;
use App\Notifications\SendInvoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $invoices = Invoice::with(['category', 'client', 'items'])
            ->withSum('items', 'price')
            ->get();

        $clients = Client::with(['user', 'partner', 'partner.user'])
            ->where('status', Client::QUALIFIED)
            ->get();

        $categories = Category::all();

        return view('staff.invoices.index', [
            'invoices' => $invoices,
            'paid_invoices' => $invoices->where('status', Invoice::PAID),
            'overdue_invoices' => $invoices->where('status', Invoice::OVERDUE),
            'draft_invoices' => $invoices->where('status', Invoice::DRAFT),
            'recurring_invoices' => $invoices->where('status', Invoice::RECURRING),
            'cancelled_invoices' => $invoices->where('status', Invoice::CANCELLED),
            'total_price' => round($invoices->sum('items_sum_price')),
            'total_price_paid' => round($invoices->where('status', Invoice::PAID)->sum('items_sum_price')),
            'total_price_overdue' => round($invoices->where('status', Invoice::OVERDUE)->sum('items_sum_price')),
            'total_price_cancelled' => round($invoices->where('status', Invoice::CANCELLED)->sum('items_sum_price')),
            'status_labels' => Invoice::getStatusLabels(),
            'statuses' => Invoice::getStatuses(),
            'clients' => $clients,
            'categories' => $categories
        ]);
    }

    public function filtered(Request $request) {
        $invoices = Invoice::with(['category', 'client', 'items'])
            ->withSum('items', 'price');

        if ($request->input('clients')) {
            $invoices = $invoices->whereIn('invoices.client_id', $request->input('clients'));
        }

        if ($request->input('start_date') && $request->input('end_date')) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            $invoices = $invoices->whereBetween('invoices.created_at', [$start_date, $end_date]);
        }

        if ($request->input('statuses')) {
            $invoices = $invoices->whereIn('invoices.status', $request->input('statuses'));
        }

        if ($request->input('categories')) {
            $invoices = $invoices->whereIn('invoices.category_id', $request->input('categories'));
        }

        $invoices = $invoices->get();

        // dd($invoices);

        $clients = Client::with(['user', 'partner', 'partner.user'])
            ->where('status', Client::QUALIFIED)
            ->get();

        $categories = Category::all();

        return view('staff.invoices.index', [
            'invoices' => $invoices,
            'paid_invoices' => $invoices->where('status', Invoice::PAID),
            'overdue_invoices' => $invoices->where('status', Invoice::OVERDUE),
            'draft_invoices' => $invoices->where('status', Invoice::DRAFT),
            'recurring_invoices' => $invoices->where('status', Invoice::RECURRING),
            'cancelled_invoices' => $invoices->where('status', Invoice::CANCELLED),
            'total_price' => round($invoices->sum('items_sum_price')),
            'total_price_paid' => round($invoices->where('status', Invoice::PAID)->sum('items_sum_price')),
            'total_price_overdue' => round($invoices->where('status', Invoice::OVERDUE)->sum('items_sum_price')),
            'total_price_cancelled' => round($invoices->where('status', Invoice::CANCELLED)->sum('items_sum_price')),
            'status_labels' => Invoice::getStatusLabels(),
            'statuses' => Invoice::getStatuses(),
            'clients' => $clients,
            'categories' => $categories
        ]);
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
        $code = '';

        do {
            $code = getRandomCode(6);

            $codeExists = Invoice::where('invoice_id', $code)->get();
        } while ($codeExists);

        return $code;
    }

    // Update invoice status
    public function updateInvoiceStatus(Request $request, string $id) {

        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->status = $request->status;

            $invoice->save();

            // Send notification
            Notification::send($invoice->client->user, new InvoiceStatusUpdated($invoice->client->user->name, Invoice::getStatusLabel($invoice->status)));

            // Send email
            // Mail::to($lead->user->email)->send(new LeadStatusChangedMail($lead->user->name, Client::getStatusLabel($lead->status)));

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Mark invoice sent/unsent
    public function markAsSent(Request $request, string $id) {

        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->sent = $request->sent;

            $invoice->save();

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Send Invoice
    public function sendInvoice(Request $request, string $id) {

        try {
            $invoice = Invoice::withSum('items', 'price')->findOrFail($id);

            Notification::send($invoice->client->user, new SendInvoice($invoice, $invoice->items_sum_price));

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
