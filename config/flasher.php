<?php

declare(strict_types=1);

use Flasher\Prime\Configuration;

return Configuration::from([
    // Default notification library (e.g., 'flasher', 'toastr', 'noty', 'notyf', 'sweetalert')
    'default' => 'toastr',

    // Path to the main PHPFlasher JavaScript file
    'main_script' => '/vendor/flasher/flasher.min.js',

    // List of CSS files to style your notifications
    'styles' => [
        '/vendor/flasher/toastr.min.css',
    ],

    // Set global options for all notifications (optional)
    'options' => [
        // Optional: Add global options here
        // 'closeButton' => true
        'positionClass' => 'top-center',
    ],

    'plugins' => [
        'toastr' => [
            'options' => [
                // Optional: Add global options here
                // 'closeButton' => true
                'positionClass' => 'toast-top-center mt-2',
            ],
        ],
    ],

    // Automatically inject JavaScript and CSS assets into your HTML pages
    'inject_assets' => true,

    // Enable message translation using Laravel's translation service
    'translate' => true,

    // URL patterns to exclude from asset injection and flash_bag conversion
    'excluded_paths' => [],

    // Map Laravel flash message keys to notification types
    'flash_bag' => [
        'success' => ['success'],
        'error' => ['error', 'danger'],
        'warning' => ['warning', 'alarm'],
        'info' => ['info', 'notice', 'alert'],
    ],

    // Set criteria to filter which notifications are displayed (optional)
    // 'filter' => [
    //     'limit' => 5, // Maximum number of notifications to show at once
    // ],

    // Define notification presets to simplify notification creation (optional)
    // 'presets' => [
    //     'entity_saved' => [
    //         'type' => 'success',
    //         'title' => 'Entity saved',
    //         'message' => 'Entity saved successfully',
    //     ],
    // ],
]);
