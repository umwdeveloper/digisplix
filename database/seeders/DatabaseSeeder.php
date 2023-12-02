<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        if ($this->command->ask('Do you want to refresh database?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database refreshed');
        }

        $this->call(
            [
                StaffTableSeeder::class,
                PartnersTableSeeder::class,
                ClientsTableSeeder::class,
                ProjectTableSeeder::class,
                PhaseSeeder::class,
                TaskSeeder::class,
                UsersTableSeeder::class,
                PermissionSeeder::class,
                StaffPermissionSeeder::class,
                SupportsSeeder::class,
                SupportRepliesSeeder::class
            ]
        );
    }
}
