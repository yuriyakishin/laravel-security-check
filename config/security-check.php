<?php

return [
    'enabled' => env('SECURITY_CHECK_ENABLED', true),

    /* Version of the scoring rules shown under the score; change it when the checks or points change. */
    'ruleset' => '2026-11-14',

    /* Only the headers are needed, but a large page must not stop the check, so the limit is generous. */
    'fetch' => [
        'page_bytes' => 5 * 1024 * 1024,
    ],

    'rate_limit' => [
        'per_hour' => (int) env('SECURITY_CHECK_PER_HOUR', 10),
    ],

    /* Short: people change the server settings and check again right away. */
    'cache' => [
        'ttl' => 120,
    ],
];
