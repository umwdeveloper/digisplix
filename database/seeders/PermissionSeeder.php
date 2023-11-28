<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Permission::insert([
            [
                'name' => 'leads',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'projects',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'sales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'clients',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'chats',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'partners',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'invoices',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'support',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'emails',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
