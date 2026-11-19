<?php

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * H5: Referrer-Policy keeps the full addresses of the pages, with their parameters, from leaking to other sites.
 */
class ReferrerCheck implements SiteCheck
{
    /** Policies that send the full address to other sites. */
    public const array LEAKY = ['unsafe-url', 'no-referrer-when-downgrade'];

    public const string SNIPPET = <<<'TEXT'
        # nginx
        add_header Referrer-Policy "strict-origin-when-cross-origin" always;

        # Apache
        Header always set Referrer-Policy "strict-origin-when-cross-origin"
        TEXT;

    public function run(Snapshot $site): Check
    {
        $value = $site->header('referrer-policy');

        if ($value === null) {
            return Check::fail('H5', 5, 'none', snippet: self::SNIPPET);
        }

        // With several values the browser uses the last one it knows
        $policies = array_map('trim', explode(',', strtolower($value)));
        $evidence = ['Referrer-Policy: '.$value];

        return in_array(end($policies), self::LEAKY, true)
            ? Check::warn('H5', 2, 5, 'leaky', evidence: $evidence, snippet: self::SNIPPET)
            : Check::pass('H5', 5, 'ok', evidence: $evidence);
    }
}
