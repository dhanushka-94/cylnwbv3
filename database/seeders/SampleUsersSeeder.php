<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleUsersSeeder extends Seeder
{
    /**
     * Seed a clean set of sample users for all roles.
     */
    public function run(): void
    {
        $this->command->info('👥 Creating sample users for all roles...');

        // Admin users
        $admins = [
            [
                'name'  => 'Primary Admin',
                'email' => 'admin@ceylonitsolutions.com',
                'password' => 'admin123',
            ],
            [
                'name'  => 'Store Manager',
                'email' => 'manager@ceylonitsolutions.com',
                'password' => 'manager123',
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name'  => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'role'  => 'admin',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
        }

        // Sample customer users
        $customers = [
            ['name' => 'Sample Customer One',   'email' => 'customer1@example.com'],
            ['name' => 'Sample Customer Two',   'email' => 'customer2@example.com'],
            ['name' => 'Sample Customer Three', 'email' => 'customer3@example.com'],
        ];

        foreach ($customers as $customer) {
            User::updateOrCreate(
                ['email' => $customer['email']],
                [
                    'name'  => $customer['name'],
                    'password' => Hash::make('customer123'),
                    'role'  => 'customer',
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->command->info('✅ Sample users created.');
        $this->command->info('');
        $this->command->info('🔐 ADMIN ACCOUNTS:');
        $this->command->info(' - admin@ceylonitsolutions.com / admin123');
        $this->command->info(' - manager@ceylonitsolutions.com / manager123');
        $this->command->info('');
        $this->command->info('👤 CUSTOMER ACCOUNTS (password: customer123):');
        $this->command->info(' - customer1@example.com');
        $this->command->info(' - customer2@example.com');
        $this->command->info(' - customer3@example.com');
        $this->command->info('');
    }
}

