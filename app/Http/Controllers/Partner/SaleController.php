<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Commission;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller {
    public function index() {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $invoices = Invoice::with(['category', 'client', 'items', 'client.partner', 'client.user'])
            ->addSelect(['items_sum_price' => InvoiceItem::selectRaw('SUM(price * quantity)')
                ->whereColumn('invoice_id', 'invoices.id')
                ->limit(1)])
            ->where('status', Invoice::PAID)
            ->whereHas('client', function ($query) {
                $query->where('partner_id', auth()->user()->userable->id);
            })
            ->get();

        $regionalSales = Invoice::join('clients', 'invoices.client_id', '=', 'clients.id')
            ->join('users', function ($join) {
                $join->on('users.userable_id', '=', 'clients.id')
                    ->where('users.userable_type', '=', Client::class);
            })
            ->where('invoices.status', Invoice::PAID)
            ->whereHas('client', function ($query) {
                $query->where('partner_id', auth()->user()->userable->id);
            })
            ->selectRaw('users.country as region, users.country_code AS region_code, COUNT(DISTINCT invoices.id) as sales_count')
            ->groupBy('users.country')
            ->get();

        $commissions = Commission::with(['client', 'client.user', 'client.partner', 'project'])
            ->whereHas('client', function ($query) {
                $query->where('partner_id', auth()->user()->userable->id);
            })
            ->get();

        $totalCommission = Commission::with('client')
            ->whereHas('client', function ($query) {
                $query->where('partner_id', auth()->user()->userable->id);
            })
            ->where('status', Commission::EARNED)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum(DB::raw('deal_size * (commission / 100)')) ?? 0;

        return view('partners.sales.index', [
            'invoices' => $invoices,
            'sales' => $invoices->whereBetween('created_at', [$startDate, $endDate])->count(),
            'revenue' => $commissions->whereBetween('created_at', [$startDate, $endDate])->sum('deal_size'),
            'commission' => $totalCommission,
            'status_labels' => Invoice::getStatusLabels(),
            'regional_sales' => $regionalSales,
            'commissions' => $commissions,
            'commission_statuses' => Commission::getStatuses(),
            'commission_status_labels' => Commission::getStatusLabels(),
            'commission_status_colors' => Commission::getStatusColors(),
        ]);
    }

    public function totalSales(Request $request) {

        $duration = $request->input('duration');

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
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->whereHas('client', function ($query) {
                $query->where('partner_id', auth()->user()->userable->id);
            })
            ->get();

        $sales = $invoices->count();

        return response()->json(['total' =>  $sales]);
    }

    public function totalRevenue(Request $request) {

        $duration = $request->input('duration');

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

        $commissions = Commission::with(['client'])
            ->whereHas('client', function ($query) {
                $query->where('partner_id', auth()->user()->userable->id);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        return response()->json(['total' => $commissions->sum('deal_size')]);
    }

    public function totalCommission(Request $request) {

        $duration = $request->input('duration');

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

        $totalCommission = Commission::with('client')
            ->whereHas('client', function ($query) {
                $query->where('partner_id', auth()->user()->userable->id);
            })
            ->where('status', Commission::EARNED)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum(DB::raw('deal_size * (commission / 100)')) ?? 0;

        return response()->json(['total' => $totalCommission]);
    }
}
