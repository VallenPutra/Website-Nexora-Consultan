<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Insight;
use App\Models\Project;
use App\Models\Revenue;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default NEXORA admin account for local/dev use.
        // firstOrCreate() so re-running `php artisan db:seed` is safe and
        // won't error out or duplicate the account.
        //
        // Login with:
        //   email:    admin@nexora.test
        //   password: password
        //
        // Change this password immediately if this is ever run anywhere
        // other than local development.
        User::firstOrCreate(
            ['email' => 'admin@nexora.test'],
            [
                'name' => 'Vallen',
                'password' => 'password', // hashed automatically via the model's 'hashed' cast
                'email_verified_at' => now(),
                'role' => 'admin',
            ]
        );

        $clients = [
            ['name' => 'Siti Rahma', 'company' => 'Klinik Sehat', 'email' => 'siti@kliniksehat.test', 'phone' => '+62 812 3456 7890', 'industry' => 'Healthcare'],
            ['name' => 'Andi Pratama', 'company' => 'PT Maju Digital', 'email' => 'andi@majudigital.test', 'phone' => '+62 811 2345 6789', 'industry' => 'Technology'],
            ['name' => 'Budi Santoso', 'company' => 'Toko Elektronik Jaya', 'email' => 'budi@tokojaya.test', 'phone' => '+62 813 9876 5432', 'industry' => 'Retail'],
        ];

        foreach ($clients as $client) {
            Client::firstOrCreate(
                ['email' => $client['email']],
                [...$client, 'status' => 'active']
            );
        }

        $projects = [
            ['client_email' => 'siti@kliniksehat.test', 'name' => 'Sistem Rekam Medis', 'service' => 'Web Development', 'progress' => 80, 'status' => 'in_progress', 'deadline' => '2026-09-20'],
            ['client_email' => 'andi@majudigital.test', 'name' => 'Cloud Migration Phase 1', 'service' => 'Cloud Solutions', 'progress' => 30, 'status' => 'planning', 'deadline' => '2026-10-10'],
            ['client_email' => 'budi@tokojaya.test', 'name' => 'E-Commerce Platform', 'service' => 'Web Development', 'progress' => 100, 'status' => 'completed', 'deadline' => '2026-08-30'],
        ];

        foreach ($projects as $project) {
            $client = Client::where('email', $project['client_email'])->firstOrFail();

            Project::firstOrCreate(
                ['name' => $project['name']],
                [
                    'client_id' => $client->id,
                    'service' => $project['service'],
                    'progress' => $project['progress'],
                    'status' => $project['status'],
                    'deadline' => $project['deadline'],
                ]
            );
        }

        $revenues = [
            ['client_email' => 'budi@tokojaya.test', 'project_name' => 'E-Commerce Platform', 'description' => 'E-Commerce Platform — Final Payment', 'amount' => 27_000_000, 'status' => 'paid', 'invoice_date' => now()->subMonth()->startOfMonth()->addDays(4)->format('Y-m-d'), 'paid_at' => now()->subMonth()->startOfMonth()->addDays(9)->format('Y-m-d')],
            ['client_email' => 'siti@kliniksehat.test', 'project_name' => 'Sistem Rekam Medis', 'description' => 'Sistem Rekam Medis — Milestone 2', 'amount' => 18_000_000, 'status' => 'paid', 'invoice_date' => now()->startOfMonth()->addDays(2)->format('Y-m-d'), 'paid_at' => now()->startOfMonth()->addDays(6)->format('Y-m-d')],
            ['client_email' => 'andi@majudigital.test', 'project_name' => 'Cloud Migration Phase 1', 'description' => 'Cloud Migration Phase 1 — Deposit', 'amount' => 15_000_000, 'status' => 'pending', 'invoice_date' => now()->format('Y-m-d'), 'paid_at' => null],
            ['client_email' => 'siti@kliniksehat.test', 'project_name' => null, 'description' => 'Monthly Cloud Support Retainer', 'amount' => 4_500_000, 'status' => 'overdue', 'invoice_date' => now()->subDays(20)->format('Y-m-d'), 'paid_at' => null],
        ];

        foreach ($revenues as $revenue) {
            $client = Client::where('email', $revenue['client_email'])->firstOrFail();
            $project = $revenue['project_name'] ? Project::where('name', $revenue['project_name'])->first() : null;

            Revenue::firstOrCreate(
                ['description' => $revenue['description']],
                [
                    'client_id' => $client->id,
                    'project_id' => $project?->id,
                    'amount' => $revenue['amount'],
                    'status' => $revenue['status'],
                    'invoice_date' => $revenue['invoice_date'],
                    'paid_at' => $revenue['paid_at'],
                ]
            );
        }

        $serviceContent = require base_path('lang/en/content.php');

        foreach ($serviceContent['services'] as $sortOrder => $service) {
            Service::firstOrCreate(
                ['slug' => $sortOrder],
                [
                    'title' => $service['title'],
                    'short' => $service['short'],
                    'sort_order' => array_search($sortOrder, array_keys($serviceContent['services']), true),
                    'is_active' => true,
                ]
            );
        }

        foreach ($serviceContent['team'] as $sortOrder => $member) {
            TeamMember::firstOrCreate(
                ['name' => $member['name']],
                [
                    'role' => $member['role'],
                    'expertise' => $member['expertise'],
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ]
            );
        }

        foreach ($serviceContent['insights'] as $slug => $insight) {
            $body = collect($insight['body'])->map(function (array $block): string {
                return $block['type'] === 'list'
                    ? implode("\n", $block['items'])
                    : $block['text'];
            })->implode("\n\n");

            Insight::firstOrCreate(
                ['slug' => $slug],
                [
                    'category' => $insight['category'],
                    'title' => $insight['title'],
                    'excerpt' => $insight['excerpt'],
                    'author' => $insight['author'],
                    'published_at' => $insight['date'],
                    'body' => $body,
                    'is_published' => true,
                ]
            );
        }
    }
}
