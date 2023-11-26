<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Staff\PartnerController as StaffPartnerController;
use App\Http\Controllers\Staff\PhaseController;
use App\Http\Controllers\Staff\LeadController;
use App\Http\Controllers\Staff\ProjectController;
use App\Http\Controllers\Staff\TaskController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Models\Partner;
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
    ->middleware('staff')
    ->name('staff.')
    ->group(function () {
        // Staff
        Route::get('/', [StaffController::class, 'index'])
            ->name('index');

        // Leads
        Route::resource('leads', LeadController::class);
        Route::patch('/leads/update-lead-status/{lead_id}', [LeadController::class, 'updateLeadStatus'])
            ->name('leads.update_lead_status');
        Route::get('/leads/fetch_lead/{lead_id}', [LeadController::class, 'fetchLead'])
            ->name('leads.fetch_lead');

        // Projects
        Route::resource('projects', ProjectController::class)->parameters(['projects', 'filter']);
        Route::get('/projects/fetch_project/{project_id}', [ProjectController::class, 'fetchProject'])
            ->name('projects.fetch_project');

        // Phases
        Route::patch('phases/update/{phase_id}', [PhaseController::class, 'update'])
            ->name('phases.update');

        // Tasks
        Route::put('tasks/updateAll', [TaskController::class, 'updateAll'])
            ->name('tasks.updateAll');

        // Partners
        Route::resource('partners', StaffPartnerController::class);
    });

Route::domain('partner.digisplix.test')
    ->name('partner.')
    ->group(function () {
        Route::get('/', [PartnerController::class, 'index'])
            ->name('index');
    });

Route::resource('users', UsersController::class);

Auth::routes();
