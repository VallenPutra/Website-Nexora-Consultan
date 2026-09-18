<?php

$content = require __DIR__.'/../en/content.php';

$translations = [
    'solutions' => [
        'digital-transformation' => ['group' => 'Solusi Bisnis', 'title' => 'Transformasi Digital', 'short' => 'Modernisasi operasional bisnis Anda secara menyeluruh.', 'hero' => 'Transformasikan Cara Bisnis Anda Bekerja', 'subheadline' => 'Kami membantu organisasi beralih dari proses manual yang terpisah menuju operasional digital terintegrasi yang dapat berkembang.'],
        'business-process-automation' => ['group' => 'Solusi Bisnis', 'title' => 'Otomasi Proses Bisnis', 'short' => 'Hilangkan pekerjaan manual berulang dari operasional Anda.', 'hero' => 'Otomatiskan Pekerjaan yang Memperlambat Tim Anda', 'subheadline' => 'Kami merancang dan membangun otomasi untuk tugas berulang berbasis aturan yang menghabiskan waktu tim Anda.'],
        'enterprise-software' => ['group' => 'Solusi Bisnis', 'title' => 'Perangkat Lunak Enterprise', 'short' => 'Sistem khusus yang dibangun sesuai cara bisnis Anda bekerja.', 'hero' => 'Perangkat Lunak yang Dibangun untuk Bisnis Anda', 'subheadline' => 'Saat perangkat siap pakai tidak lagi sesuai, kami merancang dan membangun perangkat lunak enterprise yang sesuai operasional Anda.'],
        'it-strategy-consulting' => ['group' => 'Solusi Bisnis', 'title' => 'Strategi & Konsultasi TI', 'short' => 'Peta jalan teknologi yang selaras dengan tujuan bisnis.', 'hero' => 'Peta Jalan Teknologi yang Mendukung Tujuan Bisnis Anda', 'subheadline' => 'Kami membantu pimpinan mengubah tujuan bisnis menjadi rencana teknologi yang praktis dan terprioritas.'],
        'cloud-solutions' => ['group' => 'Solusi Teknologi', 'title' => 'Solusi Cloud', 'short' => 'Infrastruktur andal dan skalabel tanpa beban berlebih.', 'hero' => 'Infrastruktur yang Berkembang Bersama Bisnis Anda', 'subheadline' => 'Kami merancang, memigrasikan, dan mengelola infrastruktur cloud agar sistem tetap cepat, aman, dan tersedia.'],
        'system-integration' => ['group' => 'Solusi Teknologi', 'title' => 'Integrasi Sistem', 'short' => 'Hubungkan perangkat Anda agar data mengalir otomatis.', 'hero' => 'Buat Sistem Anda Bekerja sebagai Satu Kesatuan', 'subheadline' => 'Kami menghubungkan aplikasi yang diandalkan bisnis Anda agar informasi mengalir otomatis di antaranya.'],
        'data-analytics' => ['group' => 'Solusi Teknologi', 'title' => 'Data & Analitik', 'short' => 'Ubah data yang tersebar menjadi keputusan terpercaya.', 'hero' => 'Ubah Data Bisnis Menjadi Wawasan yang Dapat Ditindaklanjuti', 'subheadline' => 'Kami membantu menggabungkan data bisnis dan mengubahnya menjadi dasbor yang berguna bagi pimpinan.'],
        'it-infrastructure' => ['group' => 'Solusi Teknologi', 'title' => 'Infrastruktur TI', 'short' => 'Jaringan, server, dan fondasi TI yang dapat diandalkan.', 'hero' => 'Infrastruktur TI yang Dapat Anda Andalkan', 'subheadline' => 'Kami merancang, menerapkan, dan memelihara jaringan, server, serta sistem yang menjalankan bisnis Anda.'],
    ],
    'services' => [
        'it-consulting' => ['title' => 'Konsultasi TI', 'short' => 'Saran independen untuk keputusan teknologi yang penting.', 'hero' => 'Konsultasi TI yang Mengutamakan Bisnis Anda', 'subheadline' => 'Panduan independen dan netral vendor untuk membantu Anda mengambil keputusan teknologi dengan yakin.'],
        'web-development' => ['title' => 'Pengembangan Web', 'short' => 'Website dan platform web yang cepat, aman, serta mudah dipelihara.', 'hero' => 'Website dan Platform Web yang Dibangun untuk Berkinerja', 'subheadline' => 'Dari website perusahaan hingga aplikasi web kompleks, semuanya dibuat cepat, aman, dan mudah dipelihara.'],
        'mobile-app-development' => ['title' => 'Pengembangan Aplikasi Mobile', 'short' => 'Aplikasi native dan lintas platform untuk iOS dan Android.', 'hero' => 'Aplikasi Mobile yang Memperluas Bisnis Anda', 'subheadline' => 'Kami merancang dan membangun aplikasi mobile yang memberi pelanggan atau tim Anda pengalaman andal di mana saja.'],
        'ui-ux-design' => ['title' => 'Desain UI/UX', 'short' => 'Antarmuka yang jelas, mudah digunakan, dan sesuai merek.', 'hero' => 'Desain yang Membuat Teknologi Lebih Mudah Digunakan', 'subheadline' => 'Kami merancang antarmuka yang intuitif bagi pengguna dan konsisten dengan merek Anda.'],
        'erp-odoo' => ['title' => 'Implementasi ERP & Odoo', 'short' => 'Sederhanakan operasional dengan ERP yang dikonfigurasi tepat.', 'hero' => 'Satu Sistem untuk Seluruh Operasional Anda', 'subheadline' => 'Kami menerapkan dan menyesuaikan sistem ERP, termasuk Odoo, agar operasional terhubung dalam satu platform.'],
        'cloud-management' => ['title' => 'Manajemen Cloud & Server', 'short' => 'Manajemen berkelanjutan agar infrastruktur tetap sehat.', 'hero' => 'Manajemen Infrastruktur Tanpa Beban Tim Internal', 'subheadline' => 'Kami mengelola lingkungan cloud dan server agar tim Anda dapat fokus pada bisnis, bukan infrastruktur.'],
        'cybersecurity' => ['title' => 'Keamanan Siber', 'short' => 'Lindungi sistem, data, dan reputasi Anda.', 'hero' => 'Keamanan Siber Praktis untuk Bisnis yang Berkembang', 'subheadline' => 'Kami membantu mengidentifikasi risiko dan menerapkan perlindungan praktis tanpa kompleksitas yang tidak perlu.'],
        'maintenance-support' => ['title' => 'Pemeliharaan & Dukungan', 'short' => 'Dukungan andal dan responsif setelah peluncuran.', 'hero' => 'Dukungan Berkelanjutan yang Dapat Diandalkan', 'subheadline' => 'Kami menyediakan pemeliharaan dan dukungan berkelanjutan agar sistem tetap berjalan baik setelah diluncurkan.'],
    ],
    'industries' => [
        'manufacturing' => ['title' => 'Manufaktur', 'short' => 'Hubungkan produksi, inventaris, dan operasional.', 'hero' => 'Teknologi untuk Operasional Manufaktur Modern'],
        'healthcare' => ['title' => 'Kesehatan', 'short' => 'Sistem aman untuk layanan pasien dan operasional.', 'hero' => 'Teknologi Andal dan Aman untuk Penyedia Layanan Kesehatan'],
        'education' => ['title' => 'Pendidikan', 'short' => 'Sistem yang mendukung pembelajaran dan administrasi.', 'hero' => 'Teknologi yang Mendukung Institusi dan Siswa'],
        'retail' => ['title' => 'Ritel & E-Commerce', 'short' => 'Satukan operasional online dan offline.', 'hero' => 'Teknologi untuk Ritel dan E-Commerce Modern'],
        'finance' => ['title' => 'Keuangan', 'short' => 'Sistem aman dan akurat untuk operasional keuangan.', 'hero' => 'Teknologi Andal untuk Operasional Keuangan'],
        'government' => ['title' => 'Pemerintahan & Layanan Publik', 'short' => 'Layanan digital untuk institusi publik.', 'hero' => 'Solusi Digital untuk Layanan Sektor Publik'],
        'startup' => ['title' => 'Startup & Teknologi', 'short' => 'Bangun fondasi teknis yang kuat dengan cepat.', 'hero' => 'Fondasi Teknis yang Berkembang Bersama Startup Anda'],
    ],
    'insights' => [
        'digital-transformation-business' => ['category' => 'Transformasi Digital', 'title' => 'Bagaimana Transformasi Digital Membantu Bisnis Modern', 'excerpt' => 'Transformasi digital bukan lagi pilihan. Berikut maknanya bagi bisnis yang berkembang secara praktis.'],
        'cloud-infrastructure' => ['category' => 'Cloud', 'title' => 'Mengapa Bisnis Membutuhkan Infrastruktur Cloud', 'excerpt' => 'Server lokal membawa biaya dan risiko tersembunyi. Berikut alasan bisnis beralih ke cloud dengan aman.'],
        'erp-for-growing-business' => ['category' => 'ERP', 'title' => 'Memahami ERP untuk Perusahaan yang Berkembang', 'excerpt' => 'Seiring bisnis tumbuh, perangkat yang terpisah menjadi beban. Berikut cara ERP mengatasinya.'],
        'business-automation' => ['category' => 'Bisnis', 'title' => 'Meningkatkan Efisiensi Bisnis melalui Otomasi', 'excerpt' => 'Pekerjaan manual kecil yang menumpuk menghabiskan waktu. Otomasi terarah dapat mengembalikannya kepada tim Anda.'],
        'cybersecurity-basics' => ['category' => 'Keamanan TI', 'title' => 'Dasar-Dasar Keamanan Siber untuk Perusahaan Modern', 'excerpt' => 'Anda tidak membutuhkan anggaran keamanan enterprise untuk mengurangi risiko secara berarti.'],
        'ai-readiness-for-business' => ['category' => 'Kecerdasan Buatan', 'title' => 'Mempersiapkan Bisnis untuk Adopsi AI yang Praktis', 'excerpt' => 'Adopsi AI yang berhasil dimulai dari masalah bisnis yang jelas, data yang andal, dan tim yang siap menggunakan hasilnya.'],
        'api-integration-business-systems' => ['category' => 'Teknologi', 'title' => 'Mengapa Integrasi API Penting bagi Bisnis yang Berkembang', 'excerpt' => 'Sistem yang terhubung mengurangi pekerjaan berulang, meningkatkan visibilitas, dan memberikan gambaran operasional yang lebih andal.'],
        'data-governance-foundations' => ['category' => 'Data & Analitik', 'title' => 'Membangun Fondasi Tata Kelola Data yang Kuat', 'excerpt' => 'Kepemilikan yang jelas dan praktik data yang konsisten membantu organisasi mengambil keputusan dengan lebih cepat dan percaya diri.'],
        'zero-trust-security-principles' => ['category' => 'Keamanan TI', 'title' => 'Memahami Prinsip Keamanan Zero Trust', 'excerpt' => 'Zero trust membantu organisasi mengurangi risiko dengan memverifikasi setiap permintaan dan membatasi akses sesuai kebutuhan.'],
    ],
    'team' => [
        0 => ['role' => 'Direktur Utama', 'expertise' => 'Strategi TI, konsultasi enterprise'],
        1 => ['role' => 'Kepala Engineering', 'expertise' => 'Perangkat lunak enterprise, arsitektur sistem'],
        2 => ['role' => 'Kepala Cloud & Infrastruktur', 'expertise' => 'Migrasi cloud, manajemen infrastruktur'],
        3 => ['role' => 'Lead Desainer UI/UX', 'expertise' => 'Desain produk, sistem desain'],
        4 => ['role' => 'Lead Implementasi ERP', 'expertise' => 'Odoo, desain proses bisnis'],
        5 => ['role' => 'Kepala Keamanan Siber', 'expertise' => 'Audit keamanan, penguatan infrastruktur'],
    ],
    'careers' => [
        0 => ['title' => 'Senior Full-Stack Developer', 'type' => 'Penuh waktu · Hybrid', 'summary' => 'Bangun dan pelihara aplikasi web enterprise untuk klien kami di berbagai industri.'],
        1 => ['title' => 'Cloud Infrastructure Engineer', 'type' => 'Penuh waktu · Hybrid', 'summary' => 'Rancang, migrasikan, dan kelola infrastruktur cloud untuk bisnis yang berkembang.'],
        2 => ['title' => 'Desainer UI/UX', 'type' => 'Penuh waktu · Di kantor', 'summary' => 'Rancang antarmuka intuitif untuk perangkat lunak enterprise dan produk klien.'],
        3 => ['title' => 'Konsultan ERP / Odoo', 'type' => 'Penuh waktu · Hybrid', 'summary' => 'Terapkan dan konfigurasi sistem ERP sesuai operasional klien.'],
        4 => ['title' => 'Analis Bisnis TI', 'type' => 'Penuh waktu · Hybrid', 'summary' => 'Jembatani kebutuhan bisnis dan eksekusi teknis dalam proyek konsultasi.'],
    ],
    'partners' => [
        'Mitra Infrastruktur Cloud' => ['Amazon Web Services', 'Google Cloud Platform', 'Microsoft Azure'],
        'Mitra Perangkat Lunak Enterprise' => ['Odoo', 'Microsoft 365', 'Salesforce'],
        'Mitra Keamanan & Pemantauan' => ['Cloudflare', 'Datadog', 'Okta'],
    ],
];

return array_replace_recursive($content, $translations);
