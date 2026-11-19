<?php

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * H1: Strict-Transport-Security makes browsers open the site only over https, for at least half a year.
 */
class HstsCheck implements SiteCheck
{
    /** Half a year, the shortest max-age worth having. */
    public const int MIN_AGE = 15_552_000;

    public const string SNIPPET = <<<'TEXT'
        # nginx
        add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;

        # Apache
        Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
        TEXT;

    public function run(Snapshot $site): Check
    {
        if (!$site->isHttps()) {
            return Check::skip('H1', 10, 'no_https');
        }

        $value = $site->header('strict-transport-security');

        if ($value === null) {
            return Check::fail('H1', 10, 'none', snippet: self::SNIPPET);
        }

        preg_match('/max-age\s*=\s*"?(\d+)/i', $value, $age);
        $seconds = (int) ($age[1] ?? 0);
        $evidence = ['Strict-Transport-Security: '.$value];

        if ($seconds < self::MIN_AGE) {
            return Check::warn('H1', 5, 10, 'short', ['days' => intdiv($seconds, 86400)], $evidence, self::SNIPPET);
        }

        if (stripos($value, 'includesubdomains') === false) {
            return Check::warn('H1', 8, 10, 'no_subdomains', evidence: $evidence, snippet: self::SNIPPET);
        }

        return Check::pass('H1', 10, 'ok', ['days' => intdiv($seconds, 86400)], $evidence);
    }
}
