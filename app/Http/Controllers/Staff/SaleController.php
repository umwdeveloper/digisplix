<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller {
    public function index() {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $invoices = Invoice::with(['category', 'client', 'items', 'client.partner', 'client.user'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->where('status', Invoice::PAID)
            ->where('recurring', 0)
            ->get();

        $regionalSales = Invoice::join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('users', function ($join) {
                $join->on('users.userable_id', '=', 'clients.id')
                    ->where('users.userable_type', '=', Client::class);
            })
            ->where('invoices.status', Invoice::PAID)
            ->selectRaw('users.country as region, users.country_code AS region_code, COUNT(DISTINCT invoices.id) as sales_count')
            ->groupBy('users.country')
            ->get();

        $deliveries = Project::with('client.user')->orderBy('deadline')->take(5)->get();

        return view('staff.sales.index', [
            'invoices' => $invoices,
            'sales' => $invoices->whereBetween('created_at', [$startDate, $endDate])->count(),
            'revenue' => $invoices->whereBetween('created_at', [$startDate, $endDate])->sum('items_sum_price'),
            'commission' => $invoices->whereBetween('created_at', [$startDate, $endDate])->sum('items_sum_price') * (auth()->user()->userable->commission / 100),
            'status_labels' => Invoice::getStatusLabels(),
            'regional_sales' => $regionalSales,
            'deliveries' => $deliveries
        ]);
    }

    public function totalSales(Request $request) {

        $duration = $request->input('duration');
        $filter = $request->input('filter');

        $startDate = null;
        $endDate = null;

        // Define date ranges based on the selected duration
        switch ($duration) {
            case 'weekly':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'monthly':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'months_6':
                $startDate = now()->subMonths(6)->startOfDay();
                $endDate = now()->endOfDay();
                break;
            case 'yearly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                break;
            case 'lifetime':
                break;
            default:
                break;
        }

        $invoices = Invoice::with(['client'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->where('status', Invoice::PAID)
            ->where('recurring', 0)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        $sales = $invoices->count();
        $revenue = round($invoices->sum('items_sum_price'));
        $commission = round($invoices->sum('items_sum_price') * (auth()->user()->userable->commission / 100));

        return response()->json(['total' => $filter == 'sales' ? number_format($sales, 0, ',') : ($filter == 'revenue' ? number_format($revenue, 0, ',') : number_format($commission, 0, ','))]);
    }
}
