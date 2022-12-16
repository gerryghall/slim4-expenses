<?php

// Dev environment

return function (array $settings): array {
    $settings['error']['display_error_details'] = true;
    $settings['logger']['level'] = \Monolog\Level::Debug;

    // Database
    $settings['db']['database'] = 'expense_claim';
    $settings['db']['username'] = 'root';
    $settings['db']['password'] = 'root';
    $settings['db']['host'] = 'db';

    return $settings;
};
