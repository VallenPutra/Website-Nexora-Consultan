<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfolioItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['East Java Culture and Tourism Office', 'Dinas Kebudayaan dan Pariwisata Jawa Timur', 'Data collection application', 'Aplikasi pendataan', 'application'],
            ['Flashcom Indonesia', 'Flashcom Indonesia', 'Learning institution website', 'Website lembaga pembelajaran', 'website'],
            ['Telecollection Software', 'Telecollection Software', 'Bank agency telecollection software for PT Chrismalis Artha', 'Software telecollection untuk agency bank PT Chrismalis Artha', 'application'],
            ['PT Chrismalis Artha', 'PT Chrismalis Artha', 'Company website', 'Website perusahaan', 'website'],
            ['CV Widya Bahari', 'CV Widya Bahari', 'Financial bookkeeping application', 'Aplikasi pembukuan keuangan', 'application'],
            ['Bampel Church, Merauke', 'Gereja Bampel Merauke', 'Organization profile website', 'Website profil organisasi', 'website'],
            ['Indomobil Group', 'Indomobil Group', 'Automotive sales solution', 'Solusi jual beli otomotif', 'application'],
            ['IT Blueprint', 'IT Blueprint', 'Enterprise Architecture', 'Enterprise Architecture', 'consulting'],
            ['PT Chrismalis Artha Company Profile Book', 'Company Profile Book PT Chrismalis Artha', 'Printed company profile book', 'Buku profil perusahaan', 'multimedia'],
            ['Gresik Cooperatives, SMEs and Industry Office', 'Dinas Koperasi, UKM dan Perindustrian Gresik', 'Institutional website', 'Website instansi', 'website'],
            ['Diet Cepat Sehat', 'Diet Cepat Sehat', 'Independent distributor website', 'Website distributor independen', 'website'],
            ['Inventory Application', 'Aplikasi Inventory', 'Stock management application', 'Aplikasi pengelolaan stok', 'application'],
        ];

        foreach ($items as $sortOrder => [$nameEn, $nameId, $workEn, $workId, $category]) {
            PortfolioItem::firstOrCreate(
                ['name_en' => $nameEn],
                [
                    'name_id' => $nameId,
                    'work_id' => $workId,
                    'work_en' => $workEn,
                    'category' => $category,
                    'sort_order' => $sortOrder,
                ]
            );
        }
    }
}
