<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Partner\ClientController as PartnerClientController;
use App\Http\Controllers\Partner\LeadController as PartnerLeadController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Staff\PartnerController as StaffPartnerController;
use App\Http\Controllers\Staff\ClientController as StaffClientController;
use App\Http\Controllers\Staff\StaffController as StaffStaffController;
use App\Http\Controllers\Staff\PhaseController;
use App\Http\Controllers\Staff\LeadController;
use App\Http\Controllers\Staff\ProjectController;
use App\Http\Controllers\Staff\TaskController;
use App\Http\Controllers\Staff\SupportController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TwoFAController;
use App\Http\Controllers\UsersController;
use App\Mail\TwoFA;
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

Route::domain('admin.digisplix.test')
    ->middleware(['staff', '2fa'])
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
        Route::resource('partners', StaffPartnerController::class)->except(['create', 'show', 'edit']);
        Route::get('/partners/fetch_partner/{partner_id}', [StaffPartnerController::class, 'fetchPartner'])
            ->name('partners.fetch_partner');

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
        Route::resource('support', SupportController::class);
        Route::post('/support/uploadAttachment', [SupportController::class, 'uploadAttachment'])
            ->name('support.upload_attachment');
        Route::post('/support/store_reply', [SupportController::class, 'storeReply'])
            ->name('support.store_reply');
        Route::patch('/support/update_status/{id}', [SupportController::class, 'updateStatus'])
            ->name('support.update_status');

        // If route not found
        Route::fallback(function () {
            abort(404);
        });
    });

Route::domain('partner.digisplix.test')
    ->name('partner.')
    ->group(function () {
        Route::put('/update/{id}', [PartnerController::class, 'update'])
            ->name('update');
        Route::get('/profile', [PartnerController::class, 'profile'])
            ->name('profile');
        Route::get('/settings', [PartnerController::class, 'settings'])
            ->name('settings');
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
    });

Route::resource('users', UsersController::class);

Auth::routes();

// 2FA
Route::get('/2fa/index', [TwoFAController::class, 'index'])
    ->name('2fa.index');
Route::get('/sendCode', [TwoFAController::class, 'sendCode'])
    ->name('2fa.sendCode');
Route::post('/confirmCode', [TwoFAController::class, 'confirmCode'])
    ->name('2fa.confirmCode');
Route::post('/disable2FA', [TwoFAController::class, 'disable2FA'])
    ->name('2fa.disable2FA');
