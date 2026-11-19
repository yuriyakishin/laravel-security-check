<?php

declare(strict_types=1);

namespace Yu\SecurityCheck\Checks;

use Illuminate\Support\Str;
use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * H6: Permissions-Policy turns off the camera, microphone, location and other features the site does not use.
 */
class PermissionsCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # nginx
        add_header Permissions-Policy "camera=(), microphone=(), geolocation=(), payment=()" always;

        # Apache
        Header always set Permissions-Policy "camera=(), microphone=(), geolocation=(), payment=()"
        TEXT;

    public function run(Snapshot $site): Check
    {
        $value = $site->header('permissions-policy');

        if ($value !== null) {
            return Check::pass('H6', 5, 'ok', evidence: [Str::limit('Permissions-Policy: '.$value, 300)]);
        }

        $legacy = $site->header('feature-policy');

        return $legacy !== null
            ? Check::warn('H6', 2, 5, 'legacy', evidence: [Str::limit('Feature-Policy: '.$legacy, 300)], snippet: self::SNIPPET)
            : Check::fail('H6', 5, 'none', snippet: self::SNIPPET);
    }
}
