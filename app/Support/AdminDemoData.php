<?php

namespace App\Support;

/**
 * Demo data for the NEXORA admin dashboard.
 *
 * IMPORTANT: There are currently no Eloquent models/migrations for
 * Projects, Clients, Team, Consultation Requests, or Revenue. Per the
 * brief, we do not scaffold a full CRUD/migration set up front — instead
 * every method here returns clearly-labelled demo data, structured the
 * way the real Eloquent queries would eventually return it, so swapping
 * this class out for real models later is a drop-in replacement:
 * the controller and views don't need to change shape, only the source.
 */
class AdminDemoData
{
    /** Whether the dashboard is currently backed by real business models. */
    public static function isLive(): bool
    {
        return false;
    }

    public static function stats(): array
    {
        return [
            [
                'label' => 'Total Projects',
                'value' => '24',
                'trend' => '+3 this month',
                'trend_direction' => 'up',
                'icon' => 'projects',
            ],
            [
                'label' => 'Active Projects',
                'value' => '8',
                'trend' => 'Currently in progress',
                'trend_direction' => 'neutral',
                'icon' => 'active',
            ],
            [
                'label' => 'Total Clients',
                'value' => '15',
                'trend' => '5 new clients this year',
                'trend_direction' => 'up',
                'icon' => 'clients',
            ],
            [
                'label' => 'Pending Requests',
                'value' => '6',
                'trend' => 'Needs attention',
                'trend_direction' => 'attention',
                'icon' => 'requests',
            ],
            [
                'label' => 'Monthly Revenue',
                'value' => 'Rp22.500.000',
                'trend' => 'Demo financial data',
                'trend_direction' => 'neutral',
                'icon' => 'revenue',
            ],
        ];
    }

    public static function projects(): array
    {
        return [
            [
                'name' => 'Sistem Rekam Medis',
                'client' => 'Klinik Sehat',
                'service' => 'Web Development',
                'progress' => 80,
                'status' => 'In Progress',
                'deadline' => '2026-09-20',
            ],
            [
                'name' => 'Odoo Inventory Implementation',
                'client' => 'PT Nusantara',
                'service' => 'ERP & Odoo',
                'progress' => 55,
                'status' => 'In Progress',
                'deadline' => '2026-09-25',
            ],
            [
                'name' => 'Company Profile Website',
                'client' => 'Nusa Indo Konsultan',
                'service' => 'Web Development',
                'progress' => 100,
                'status' => 'Completed',
                'deadline' => '2026-08-30',
            ],
            [
                'name' => 'Cloud Migration Phase 1',
                'client' => 'PT Maju Digital',
                'service' => 'Cloud Solutions',
                'progress' => 30,
                'status' => 'Planning',
                'deadline' => '2026-10-10',
            ],
            [
                'name' => 'Security Audit & Hardening',
                'client' => 'Bank Sentosa',
                'service' => 'Cybersecurity',
                'progress' => 95,
                'status' => 'On Review',
                'deadline' => '2026-09-22',
            ],
        ];
    }

    public static function revenueByMonth(): array
    {
        return [
            ['month' => 'Apr', 'amount' => 12_000_000],
            ['month' => 'May', 'amount' => 18_000_000],
            ['month' => 'Jun', 'amount' => 15_000_000],
            ['month' => 'Jul', 'amount' => 22_000_000],
            ['month' => 'Aug', 'amount' => 27_000_000],
            ['month' => 'Sep', 'amount' => 22_500_000],
        ];
    }

    public static function consultationRequests(): array
    {
        return [
            [
                'name' => 'Andi Pratama',
                'company' => 'PT Maju Digital',
                'service' => 'ERP & Odoo Implementation',
                'date' => 'Today',
                'status' => 'New',
            ],
            [
                'name' => 'Siti Rahma',
                'company' => 'Klinik Sehat',
                'service' => 'Medical Record System',
                'date' => 'Yesterday',
                'status' => 'In Review',
            ],
            [
                'name' => 'Budi Santoso',
                'company' => 'Toko Elektronik Jaya',
                'service' => 'E-Commerce Platform',
                'date' => '2 days ago',
                'status' => 'Contacted',
            ],
            [
                'name' => 'Maria Christina',
                'company' => 'Yayasan Cerdas Bangsa',
                'service' => 'Learning Management System',
                'date' => '3 days ago',
                'status' => 'Converted',
            ],
        ];
    }

    public static function recentActivity(): array
    {
        return [
            [
                'description' => 'New consultation request received from Andi Pratama',
                'time' => '2 minutes ago',
                'icon' => 'requests',
                'tone' => 'accent',
            ],
            [
                'description' => 'Project "Sistem Rekam Medis" updated to 80%',
                'time' => '25 minutes ago',
                'icon' => 'projects',
                'tone' => 'info',
            ],
            [
                'description' => 'New client "PT Nusantara" added',
                'time' => '1 hour ago',
                'icon' => 'clients',
                'tone' => 'success',
            ],
            [
                'description' => 'Insight article "Cybersecurity Basics for Modern Companies" published',
                'time' => '3 hours ago',
                'icon' => 'insights',
                'tone' => 'info',
            ],
            [
                'description' => 'Team member "Bagus Prasetyo" profile updated',
                'time' => 'Yesterday',
                'icon' => 'team',
                'tone' => 'neutral',
            ],
            [
                'description' => 'Monthly revenue report generated',
                'time' => 'Yesterday',
                'icon' => 'revenue',
                'tone' => 'neutral',
            ],
        ];
    }

    public static function upcomingDeadlines(): array
    {
        return [
            ['project' => 'Sistem Rekam Medis', 'deadline' => '2026-09-20', 'priority' => 'High'],
            ['project' => 'Security Audit & Hardening', 'deadline' => '2026-09-22', 'priority' => 'High'],
            ['project' => 'Odoo Inventory Implementation', 'deadline' => '2026-09-25', 'priority' => 'Medium'],
            ['project' => 'Company Profile Website', 'deadline' => '2026-09-30', 'priority' => 'Low'],
        ];
    }

    /** Sidebar modules that don't have a real page yet — shown as a clear "Coming Soon" state instead of a 404. */
    public static function placeholderModules(): array
    {
        return [
            'projects' => ['label' => 'Projects', 'description' => 'Create, track, and manage every client project — timelines, deliverables, and team assignments in one place.'],
            'services' => ['label' => 'Services', 'description' => 'Manage the service catalog shown on the public site, including pricing notes and delivery scope.'],
            'clients' => ['label' => 'Clients', 'description' => 'A full client directory with contact details, active projects, and history.'],
            'team' => ['label' => 'Team', 'description' => 'Manage team member profiles, roles, and the public Our Team page.'],
            'insights' => ['label' => 'Insights', 'description' => 'Write, edit, and publish articles to the public Insights blog.'],
            'media-library' => ['label' => 'Media Library', 'description' => 'Upload and organize images and files used across the site and dashboard.'],
            'consultation-requests' => ['label' => 'Consultation Requests', 'description' => 'A full, filterable list of every consultation request submitted through the contact form.'],
            'messages' => ['label' => 'Messages', 'description' => 'Internal messaging and notes tied to clients and projects.'],
            'reports' => ['label' => 'Reports', 'description' => 'Exportable reports across projects, clients, and revenue.'],
            'revenue' => ['label' => 'Revenue', 'description' => 'Detailed revenue tracking, invoices, and payment status.'],
            'settings' => ['label' => 'Settings', 'description' => 'Manage admin accounts, roles, and system preferences.'],
        ];
    }
}
