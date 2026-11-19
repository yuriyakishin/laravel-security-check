<?php

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * H4: X-Content-Type-Options: nosniff stops browsers from guessing file types, e.g. running an upload as a script.
 */
class NosniffCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # nginx
        add_header X-Content-Type-Options "nosniff" always;

        # Apache
        Header always set X-Content-Type-Options "nosniff"
        TEXT;

    public function run(Snapshot $site): Check
    {
        $value = $site->header('x-content-type-options');

        if ($value === null) {
            return Check::fail('H4', 5, 'none', snippet: self::SNIPPET);
        }

        return strtolower($value) === 'nosniff'
            ? Check::pass('H4', 5, 'ok')
            : Check::fail('H4', 5, 'invalid', evidence: ['X-Content-Type-Options: '.$value], snippet: self::SNIPPET);
    }
}
