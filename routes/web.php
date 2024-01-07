<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\InvoiceController as ClientInvoiceController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\Client\ServiceController;
use App\Http\Controllers\Client\SupportController as ClientSupportController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Partner\ClientController as PartnerClientController;
use App\Http\Controllers\Partner\LeadController as PartnerLeadController;
use App\Http\Controllers\Partner\SaleController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Staff\PartnerController as StaffPartnerController;
use App\Http\Controllers\Staff\ClientController as StaffClientController;
use App\Http\Controllers\Staff\CommissionController;
use App\Http\Controllers\Staff\InvoiceController;
use App\Http\Controllers\Staff\StaffController as StaffStaffController;
use App\Http\Controllers\Staff\PhaseController;
use App\Http\Controllers\Staff\LeadController;
use App\Http\Controllers\Staff\ProjectController;
use App\Http\Controllers\Staff\SaleController as StaffSaleController;
use App\Http\Controllers\Staff\TaskController;
use App\Http\Controllers\Staff\SupportController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TwoFAController;
use App\Http\Controllers\UsersController;
use App\Mail\TwoFA;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::domain(config('custom.staff_alias'))
    ->middleware(['auth', 'staff', '2fa', 'support_middleware'])
    ->name('staff.')
    ->group(function () {
        // Staff
        Route::get('/', [StaffController::class, 'index'])
            ->name('index');
        Route::put('/update/{id}', [StaffController::class, 'update'])
            ->name('update');
        Route::get('/profile', [StaffController::class, 'profile'])
            ->name('profile');
        Route::get('/settings', [StaffController::class, 'settings'])
            ->name('settings');
        Route::get('/notifications', [StaffController::class, 'notifications'])
            ->name('notifications');
        Route::patch('/reset_password', [StaffController::class, 'resetPassword'])
            ->name('reset_password');

        // Leads
        Route::resource('leads', LeadController::class)->except(['create', 'show', 'edit']);
        Route::patch('/leads/update-lead-status/{lead_id}', [LeadController::class, 'updateLeadStatus'])
            ->name('leads.update_lead_status');
        Route::get('/leads/fetch_lead/{lead_id}', [LeadController::class, 'fetchLead'])
            ->name('leads.fetch_lead');

        // Projects
        Route::resource('projects', ProjectController::class)->parameters(['projects', 'filter'])
            ->except(['create', 'edit']);
        Route::get('/projects/fetch_project/{project_id}', [ProjectController::class, 'fetchProject'])
            ->name('projects.fetch_project');

        // Phases
        Route::patch('phases/update/{phase_id}', [PhaseController::class, 'update'])
            ->name('phases.update');

        // Tasks
        Route::put('tasks/updateAll', [TaskController::class, 'updateAll'])
            ->name('tasks.updateAll');

        // Partners
        Route::resource('partners', StaffPartnerController::class)->except(['create', 'edit']);
        Route::get('/partners/fetch_partner/{partner_id}', [StaffPartnerController::class, 'fetchPartner'])
            ->name('partners.fetch_partner');
        Route::post('/partners/total_sales', [StaffPartnerController::class, 'totalSales'])->name('partners.total_sales');
        Route::post('/partners/total_revenue', [StaffPartnerController::class, 'totalRevenue'])->name('partners.total_revenue');
        Route::post('/partners/total_commission', [StaffPartnerController::class, 'totalCommission'])->name('partners.total_commission');

        // Clients
        Route::resource('clients', StaffClientController::class)->except(['create', 'store', 'show', 'edit']);
        Route::patch('/clients/update_client_status/{client_id}', [StaffClientController::class, 'updateClientStatus'])
            ->name('clients.update_client_status');
        Route::get('/clients/fetch_client/{client_id}', [StaffClientController::class, 'fetchClient'])
            ->name('clients.fetch_client');

        // Staff
        Route::resource('staff', StaffStaffController::class)->except(['create', 'show', 'edit']);
        Route::patch('/staff/update_staff_status/{staff_id}', [StaffStaffController::class, 'updateStaffStatus'])
            ->name('staff.update_staff_status');
        Route::get('/staff/fetch_staff/{staff_id}', [StaffStaffController::class, 'fetchStaff'])
            ->name('staff.fetch_staff');

        // Support
        Route::resource('support', SupportController::class)->except(['create', 'store', 'edit', 'update']);;
        Route::post('/support/uploadAttachment', [SupportController::class, 'uploadAttachment'])
            ->name('support.upload_attachment');
        Route::post('/support/store_reply', [SupportController::class, 'storeReply'])
            ->name('support.store_reply');
        Route::patch('/support/update_status/{id}', [SupportController::class, 'updateStatus'])
            ->name('support.update_status');

        // Invoice
        Route::resource('invoices', InvoiceController::class);
        Route::patch('/invoices/update-invoice-status/{invoice_id}', [InvoiceController::class, 'updateInvoiceStatus'])
            ->name('invoices.update_invoice_status');
        Route::patch('/invoices/mark-as-sent/{invoice_id}', [InvoiceController::class, 'markAsSent'])
            ->name('invoices.mark_as_sent');
        Route::patch('/invoices/send-invoice/{invoice_id}', [InvoiceController::class, 'sendInvoice'])
            ->name('invoices.send_invoice');
        Route::post('invoices/filtered', [InvoiceController::class, 'filtered'])
            ->name('invoices.filtered');
        Route::get('invoices/{invoice_id}/clone', [InvoiceController::class, 'clone'])
            ->name('invoices.clone');

        // Sales
        Route::get('/sales', [StaffSaleController::class, 'index'])->name('sales.index');
        Route::get('/total_sales', [StaffSaleController::class, 'totalSales'])->name('sales.total_sales');

        // Commissions
        Route::resource('commissions', CommissionController::class);
        Route::patch('/commissions/update_commission_status/{commission_id}', [CommissionController::class, 'updateCommissionStatus'])
            ->name('commissions.update_commission_status');
        Route::get('/commissions/fetch_commission/{commission_id}', [CommissionController::class, 'fetchCommission'])
            ->name('commissions.fetch_commission');

        // Logs
        Route::get('/logs', [StaffController::class, 'logs'])->name('logs');
        Route::get('/clear_logs', [StaffController::class, 'clearLogs'])->name('clear_logs');

        // If route not found
        Route::fallback(function () {
            abort(404);
        });
    });

Route::domain(config('custom.partner_alias'))
    ->name('partner.')
    ->middleware(['auth', '2fa', 'support_middleware'])
    ->group(function () {
        Route::put('/update/{id}', [PartnerController::class, 'update'])
            ->name('update');
        Route::get('/profile', [PartnerController::class, 'profile'])
            ->name('profile');
        Route::get('/settings', [PartnerController::class, 'settings'])
            ->name('settings');
        Route::get('/notifications', [PartnerController::class, 'notifications'])
            ->name('notifications');
        Route::patch('/reset_password', [PartnerController::class, 'resetPassword'])
            ->name('reset_password');

        // Leads
        Route::get('/', [PartnerLeadController::class, 'index'])
            ->name('leads.index');
        Route::resource('leads', PartnerLeadController::class)->except(['create', 'show', 'edit']);
        Route::patch('/leads/update-lead-status/{lead_id}', [PartnerLeadController::class, 'updateLeadStatus'])
            ->name('leads.update_lead_status');
        Route::get('/leads/fetch_lead/{lead_id}', [PartnerLeadController::class, 'fetchLead'])
            ->name('leads.fetch_lead');

        // Clients
        Route::resource('clients', PartnerClientController::class)->except(['create', 'store', 'show', 'edit']);
        Route::patch('/clients/update_client_status/{client_id}', [PartnerClientController::class, 'updateClientStatus'])
            ->name('clients.update_client_status');
        Route::get('/clients/fetch_client/{client_id}', [PartnerClientController::class, 'fetchClient'])
            ->name('clients.fetch_client');

        // Sales
        Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
        Route::post('/total_sales', [SaleController::class, 'totalSales'])->name('sales.total_sales');
        Route::post('/total_revenue', [SaleController::class, 'totalRevenue'])->name('sales.total_revenue');
        Route::post('/total_commission', [SaleController::class, 'totalCommission'])->name('sales.total_commission');

        // If route not found
        Route::fallback(function () {
            abort(404);
        });
    });

Route::domain(config('custom.client_alias'))
    ->name('client.')
    ->middleware(['auth', '2fa', 'support_middleware', 'is_client'])
    ->group(function () {
        Route::put('/update/{id}', [ClientController::class, 'update'])
            ->name('update');
        Route::get('/profile', [ClientController::class, 'profile'])
            ->name('profile');
        Route::get('/settings', [ClientController::class, 'settings'])
            ->name('settings');
        Route::get('/notifications', [ClientController::class, 'notifications'])
            ->name('notifications');
        Route::patch('/reset_password', [ClientController::class, 'resetPassword'])
            ->name('reset_password');

        // Projects
        Route::resource('projects', ClientProjectController::class)->parameters(['projects', 'filter']);
        Route::get('/', [ClientProjectController::class, 'index'])
            ->name('projects.index');

        // Support
        Route::resource('support', ClientSupportController::class)->except(['edit', 'update']);
        Route::post('/support/uploadAttachment', [ClientSupportController::class, 'uploadAttachment'])
            ->name('support.upload_attachment');
        Route::post('/support/uploadAttachmentReply', [ClientSupportController::class, 'uploadAttachmentReply'])
            ->name('support.upload_attachment_reply');
        Route::post('/support/store_reply', [ClientSupportController::class, 'storeReply'])
            ->name('support.store_reply');
        Route::patch('/support/update_status/{id}', [ClientSupportController::class, 'updateStatus'])
            ->name('support.update_status');

        // Invoices
        Route::resource('invoices', ClientInvoiceController::class);
        Route::get('/invoices/{id}/bank', [ClientInvoiceController::class, 'bank'])
            ->name('invoices.bank');

        // Services
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

        // If route not found
        Route::fallback(function () {
            abort(404);
        });
    });

Route::resource('users', UsersController::class);

Auth::routes();

// Messages
Route::get('/messages/count', [UsersController::class, 'getMessagesCount'])
    ->name('messages.count');

// 2FA
Route::get('/2fa/index', [TwoFAController::class, 'index'])
    ->name('2fa.index');
Route::get('/sendCode', [TwoFAController::class, 'sendCode'])
    ->name('2fa.sendCode');
Route::post('/confirmCode', [TwoFAController::class, 'confirmCode'])
    ->name('2fa.confirmCode');
Route::post('/disable2FA', [TwoFAController::class, 'disable2FA'])
    ->name('2fa.disable2FA');


// Payment
Route::post('/checkout', [PaymentController::class, 'createCheckoutSession'])->name('payment.create');
Route::post('/subscribe', [PaymentController::class, 'subscribe'])->name('payment.subscribe');
Route::post('/create_payment_intent', [PaymentController::class, 'createPaymentIntent'])->name('payment.create_payment_intent');
Route::post('/create_subscription', [PaymentController::class, 'createSubscription'])->name('payment.create_subscription');
Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/webhook/payment', [PaymentController::class, 'webhookPayment'])->name('payment.webhook.payment');

// Notifications
Route::get('/mark-notification-as-read', [NotificationController::class, 'markAsRead'])
    ->name('notifications.mark_as_read');
