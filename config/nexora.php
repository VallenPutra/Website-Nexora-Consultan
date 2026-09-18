<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Public admin registration
    |--------------------------------------------------------------------------
    | Anyone who can reach /register can currently create an admin account.
    | That's fine for local development, but set ADMIN_REGISTRATION_OPEN=false
    | in production's .env once you've seeded/created the accounts you need
    | (see database/seeders/DatabaseSeeder.php), so a public visitor can't
    | just sign themselves up as an admin.
    */
    'registration_open' => (bool) env('ADMIN_REGISTRATION_OPEN', true),

];
