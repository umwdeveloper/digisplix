<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Client;
use App\Models\Project;
use App\Models\Support;
use App\Models\User;
use App\Policies\ClientPolicy;
use App\Policies\LeadPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Client::class => ClientPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void {
        Gate::define('staff.index', function (User $user) {
            return true;
        });

        // Staff
        // LeadController
        Gate::define('staff.leads', function (User $user) {
            return $user->staff()->permissions->contains('name', 'leads');
        });

        // ProjectController
        Gate::define('staff.projects', function (User $user) {
            return $user->staff()->permissions->contains('name', 'projects');
        });

        // PartnerController
        Gate::define('staff.partners', function (User $user) {
            return $user->staff()->permissions->contains('name', 'partners');
        });

        // ClientController
        Gate::define('staff.clients', function (User $user) {
            return $user->staff()->permissions->contains('name', 'clients');
        });

        // ChatController
        Gate::define('staff.chats', function (User $user) {
            return $user->staff()->permissions->contains('name', 'chats');
        });

        // StaffController
        Gate::define('staff.staff', function (User $user) {
            return $user->staff()->permissions->contains('name', 'staff');
        });

        // SupportController
        Gate::define('staff.support', function (User $user) {
            return $user->staff()->permissions->contains('name', 'support');
        });

        // Partner

        // Client
        // ProjectController
        Gate::define('client.projects', function (User $user, Project $project) {
            return $project->client->id === $user->userable->id;
        });

        // SupportController
        Gate::define('client.support', function (User $user, Support $support) {
            return $support->user->id === $user->id;
        });

        // Admin has all rights
        // Gate::before(function (User $user, string $ability) {
        //     if ($user->is_admin) {
        //         return true;
        //     }
        // });
    }
}
