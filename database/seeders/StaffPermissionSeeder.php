<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffPermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $permissions = Permission::all();

        Staff::all()->each(function ($staff) use ($permissions) {
            if ($staff->user->is_admin) {
                $randomPermissions = $permissions->pluck('id');
            } else {
                $randomPermissions = $permissions->random(rand(1, $permissions->count()))->pluck('id');
            }
            $staff->permissions()->sync($randomPermissions);
        });
    }
}
