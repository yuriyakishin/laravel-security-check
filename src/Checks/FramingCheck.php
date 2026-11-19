<?php

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * H3: other sites cannot show the page in a frame and trick visitors into clicks (clickjacking).
 */
class FramingCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # nginx
        add_header X-Frame-Options "SAMEORIGIN" always;

        # Apache
        Header always set X-Frame-Options "SAMEORIGIN"

        # Or, in Content-Security-Policy: frame-ancestors 'self'
        TEXT;

    public function run(Snapshot $site): Check
    {
        $policy = (string) $site->header('content-security-policy');

        if (preg_match('/(?:^|;)\s*frame-ancestors\s+([^;]*)/i', $policy, $ancestors)) {
            return Check::pass('H3', 10, 'csp', evidence: ['frame-ancestors '.trim($ancestors[1])]);
        }

        $option = $site->header('x-frame-options');

        if ($option === null) {
            return Check::fail('H3', 10, 'none', snippet: self::SNIPPET);
        }

        return in_array(strtoupper($option), ['DENY', 'SAMEORIGIN'], true)
            ? Check::pass('H3', 10, 'ok', evidence: ['X-Frame-Options: '.$option])
            : Check::warn('H3', 3, 10, 'invalid', evidence: ['X-Frame-Options: '.$option], snippet: self::SNIPPET);
    }
}
