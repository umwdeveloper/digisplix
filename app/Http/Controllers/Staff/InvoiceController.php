<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoice;
use App\Models\Category;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\NotificationType;
use App\Models\User;
use App\Notifications\InvoiceOverdue;
use App\Notifications\InvoicePaid;
use App\Notifications\InvoiceSent;
use App\Notifications\InvoiceStatusUpdated;
use App\Notifications\SendInvoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.invoices');

        $invoices = Invoice::with(['category', 'client', 'items', 'client.user'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->get();

        $clients = Client::with(['user', 'partner', 'partner.user'])
            ->where('is_client', 1)
            ->get();

        $categories = Category::all();

        return view('staff.invoices.index', [
            'invoices' => $invoices,
            'paid_invoices' => $invoices->where('status', Invoice::PAID),
            'overdue_invoices' => $invoices->where('status', Invoice::OVERDUE),
            'draft_invoices' => $invoices->where('status', Invoice::DRAFT),
            'recurring_invoices' => $invoices->where('recurring', 1),
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
        $this->authorize('staff.invoices');

        $invoices = Invoice::with(['category', 'client', 'items'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)]);

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
            ->where('is_client', 1)
            ->get();

        $categories = Category::all();

        return view('staff.invoices.index', [
            'invoices' => $invoices,
            'paid_invoices' => $invoices->where('status', Invoice::PAID),
            'overdue_invoices' => $invoices->where('status', Invoice::OVERDUE),
            'draft_invoices' => $invoices->where('status', Invoice::DRAFT),
            'recurring_invoices' => $invoices->where('recurring', 1),
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
        $this->authorize('staff.invoices');

        $clients = Client::with('user')->where('is_client', 1)->get();
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
    public function store(StoreInvoice $request) {
        $this->authorize('staff.invoices');

        $validatedData = $request->validated();

        $invoice = Invoice::create($validatedData);

        $descriptions = $validatedData['descriptions'];
        $prices = $validatedData['prices'];
        $quantities = $validatedData['quantities'];

        foreach ($descriptions as $key => $description) {
            $invoice->items()->create([
                'description' => $description,
                'price' => $prices[$key],
                'quantity' => $quantities[$key]
            ]);
        }

        return redirect()->route('staff.invoices.index')->with('status', 'Invoice created successfully!');
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
        $this->authorize('staff.invoices');

        $invoice = Invoice::with(['category', 'client', 'items'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->findOrFail($id);
        $clients = Client::with('user')->where('is_client', 1)->get();
        $categories = Category::all();
        $admin = User::getAdmin();
        return view('staff.invoices.edit', [
            'clients' => $clients,
            'categories' => $categories,
            'admin' => $admin,
            'invoice' => $invoice,
        ]);
    }

    /**
     * Show the form for cloning the specified resource.
     */
    public function clone(string $id) {
        $this->authorize('staff.invoices');

        $invoice = Invoice::with(['category', 'client', 'items'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->findOrFail($id);
        $clients = Client::with('user')->where('is_client', 1)->get();
        $categories = Category::all();
        $admin = User::getAdmin();
        return view('staff.invoices.clone', [
            'clients' => $clients,
            'categories' => $categories,
            'admin' => $admin,
            'invoice' => $invoice,
            'invoice_number' => $this->generateInvoiceNumber(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInvoice $request, string $id) {
        $this->authorize('staff.invoices');

        $validatedData = $request->validated();

        $invoice = Invoice::findOrFail($id);

        if (!isset($validatedData['recurring'])) {
            $validatedData['recurring'] = 0;
            $validatedData['start_from'] = null;
            $validatedData['duration'] = null;
        }

        $invoice->update($validatedData);

        $invoiceItems = $invoice->items;

        $descriptions = $validatedData['descriptions'];
        $prices = $validatedData['prices'];
        $quantities = $validatedData['quantities'];

        foreach ($descriptions as $key => $description) {
            if (isset($invoiceItems[$key])) {
                // If the item already exists, update it
                $invoiceItems[$key]->update([
                    'description' => $description,
                    'price' => $prices[$key],
                    'quantity' => $quantities[$key],
                ]);
            } else {
                // If the item doesn't exist, create a new one
                $invoice->items()->create([
                    'description' => $description,
                    'price' => $prices[$key],
                    'quantity' => $quantities[$key],
                ]);
            }
        }

        foreach ($invoiceItems as $key => $item) {
            if (!isset($descriptions[$key])) {
                $item->delete();
            }
        }

        return redirect()->back()->with('status', 'Invoice updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->authorize('staff.invoices');

        $invoice = Invoice::findOrFail($id);

        $notificationTypeIds = $invoice->notificationTypes()->pluck('notification_id');

        DB::transaction(function () use ($invoice, $notificationTypeIds) {
            $invoice->notificationTypes()->delete();

            DatabaseNotification::whereIn('id', $notificationTypeIds)->delete();
        });

        $invoice->delete();

        return redirect()->back()->with('status', 'Invoice deleted successfully!');
    }

    public function generateInvoiceNumber() {
        $code = '';

        do {
            $code = getRandomCode(6);

            $codeExists = Invoice::where('invoice_id', $code)->get();
        } while ($codeExists->count() > 0);

        return $code;
    }

    // Update invoice status
    public function updateInvoiceStatus(Request $request, string $id) {
        $this->authorize('staff.invoices');

        try {
            $invoice = Invoice::with(['client', 'items'])
                ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                    ->whereColumn('invoice_id', 'invoices.id')
                    ->limit(1)])
                ->findOrFail($id);
            $invoice->status = $request->status;

            $invoice->save();

            if ($invoice->status == Invoice::PAID) {
                $invoice->client->active = 1;
                $invoice->client->save();

                Notification::send($invoice->client->user, new InvoicePaid($invoice, $invoice->items_sum_price, $invoice->id));
                // Notification::send(User::getAdmin(), new InvoicePaid($invoice, $invoice->items_sum_price, $invoice->id));
            }

            if ($invoice->status == Invoice::OVERDUE) {
                Notification::send($invoice->client->user, new InvoiceOverdue($invoice, $invoice->id, $invoice->items_sum_price));
            }

            // Send notification
            // if ($invoice->status !== Invoice::DRAFT && $invoice->status !== Invoice::PENDING && $invoice->status !== Invoice::CANCELLED && $invoice->status !== Invoice::PAID) {
            //     Notification::send($invoice->client->user, new InvoiceStatusUpdated($invoice->client->user->name, Invoice::getStatusLabel($invoice->status), $invoice->id));
            // }

            // Send email
            // Mail::to($lead->user->email)->send(new LeadStatusChangedMail($lead->user->name, Client::getStatusLabel($lead->status)));

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    // Mark invoice sent/unsent
    public function markAsSent(Request $request, string $id) {
        $this->authorize('staff.invoices');

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
        $this->authorize('staff.invoices');

        try {
            $invoice = Invoice::with(['client', 'items'])
                ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                    ->whereColumn('invoice_id', 'invoices.id')
                    ->limit(1)])
                ->findOrFail($id);

            $invoice->sent = 1;

            $invoice->save();

            Notification::send($invoice->client->user, new SendInvoice($invoice, $invoice->items_sum_price, $invoice->id));
            Notification::send(User::getAdmin(), new InvoiceSent($invoice->client->user->name, $invoice->id));

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function fetchInvoice(Request $request, string $id) {
        $this->authorize('staff.invoices');

        $invoice = Invoice::with(['items'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->findOrFail($id);
        return response()->json(['status' => 'success', 'invoice' => $invoice]);
    }
}
