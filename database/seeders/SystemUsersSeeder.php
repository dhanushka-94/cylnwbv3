<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Canonical system (staff) accounts after a fresh migrate.
 * Passwords rely on User model hashed cast — use plain strings here.
 */
class SystemUsersSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Creating system users…');

        $accounts = [
            [
                'name' => 'CITS Admin',
                'email' => 'admin@ceylonitsolutions.com',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'name' => 'Store Manager',
                'email' => 'manager@ceylonitsolutions.com',
                'password' => 'manager123',
                'role' => 'admin',
            ],
            [
                'name' => 'Dhanushka Perera',
                'email' => 'dhanushka@ceylonitsolutions.com',
                'password' => 'dhanushka123',
                'role' => 'admin',
            ],
            [
                'name' => 'Kasun Silva',
                'email' => 'kasun@ceylonitsolutions.com',
                'password' => 'kasun123',
                'role' => 'admin',
            ],
            [
                'name' => 'Nuwan Fernando',
                'email' => 'nuwan@ceylonitsolutions.com',
                'password' => 'nuwan123',
                'role' => 'admin',
            ],
        ];

        foreach ($accounts as $row) {
            User::updateOrCreate(
                ['email' => $row['email']],
                [
                    'name' => $row['name'],
                    'password' => $row['password'],
                    'role' => $row['role'],
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->command->info('System users ready (' . count($accounts) . ' accounts).');
        $this->command->warn('Change all passwords after first login in production.');
        $this->command->newLine();
        $this->command->line('  admin@ceylonitsolutions.com       → admin123');
        $this->command->line('  manager@ceylonitsolutions.com    → manager123');
        $this->command->line('  dhanushka@ceylonitsolutions.com  → dhanushka123');
        $this->command->line('  kasun@ceylonitsolutions.com      → kasun123');
        $this->command->line('  nuwan@ceylonitsolutions.com      → nuwan123');
    }
}
