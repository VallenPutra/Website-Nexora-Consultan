<?php

use App\Support\SiteContent;
use Illuminate\Contracts\Console\Kernel;

require 'vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$solutions = SiteContent::solutions();
$services = SiteContent::services();
$industries = SiteContent::industries();
$insights = SiteContent::insights();
$team = SiteContent::team();
$careers = SiteContent::careers();
$partners = SiteContent::partners();

$en = [
    'solutions' => $solutions,
    'services' => $services,
    'industries' => $industries,
    'insights' => $insights,
    'team' => $team,
    'careers' => $careers,
    'partners' => $partners,
];

$export = "<?php\n\nreturn ".var_export($en, true).";\n";
file_put_contents('lang/en/content.php', $export);
echo "Exported lang/en/content.php\n";
