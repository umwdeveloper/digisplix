<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StaffPolicy {
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool {
        return $user->userable_type === Staff::class;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Staff $staff): bool {
        return $user->userable_type === Staff::class;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool {
        return $user->userable_type === Staff::class;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Staff $staff): bool {
        return $user->userable_type === Staff::class;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Staff $staff): bool {
        return $user->userable_type === Staff::class;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Staff $staff): bool {
        return $user->userable_type === Staff::class;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Staff $staff): bool {
        return $user->userable_type === Staff::class;
    }

    public function before(User $user, string $ability): bool|null {
        return $user->is_admin ? true : false;
    }
}
