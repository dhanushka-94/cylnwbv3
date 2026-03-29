<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CleanDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting site database cleanup (data only, schema kept)...');

        $this->clearAllData();

        $this->call(SampleUsersSeeder::class);

        $this->command->info('Database cleanup and sample users completed.');
        $this->displaySummary();
    }
    
    private function clearAllData(): void
    {
        $this->command->info('🗑️ Removing all data from database...');
        
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear all tables in proper order
        $tables = [
            'activity_logs',
            'transactions',
            'order_items',
            'orders',
            'quotations',
            'sliders',
            'carts',
            'user_addresses',
            'password_reset_tokens',
            'sessions',
            'users',
            'failed_jobs',
            'jobs',
            'job_batches',
            'cache',
            'cache_locks',
            'personal_access_tokens',
        ];
        
        foreach ($tables as $table) {
            try {
                DB::table($table)->delete();
                $this->command->info("  ✅ Cleared: {$table}");
            } catch (\Exception $e) {
                $this->command->warn("  ⚠️ Table {$table} not found or already empty");
            }
        }
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('✅ All data removed from database');
    }
    
    private function displaySummary(): void
    {
        $this->command->newLine();
        $this->command->info('Summary: orders, carts, quotations, sliders, sessions, and users cleared; sample users seeded.');
        $this->command->warn('Separate products DB (if configured) is not modified.');
        $this->command->newLine();
    }
}
