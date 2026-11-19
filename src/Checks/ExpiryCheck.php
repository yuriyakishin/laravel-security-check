<?php

declare(strict_types=1);

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * C2: the certificate does not run out soon: at least 30 days are left.
 */
class ExpiryCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # Check that automatic renewal works, and look at the renewal timer
        sudo certbot renew --dry-run
        systemctl list-timers | grep certbot
        TEXT;

    public function run(Snapshot $site): Check
    {
        $certificate = $site->certificate;

        if ($certificate === null) {
            return Check::skip('C2', 10, 'none');
        }

        $days = $certificate->daysLeft();
        $replace = ['days' => $days, 'date' => date('Y-m-d', $certificate->validTo)];

        return match (true) {
            $days < 0 => Check::fail('C2', 10, 'expired', $replace, snippet: self::SNIPPET),
            $days < 7 => Check::fail('C2', 10, 'urgent', $replace, snippet: self::SNIPPET),
            $days < 30 => Check::warn('C2', 5, 10, 'soon', $replace, snippet: self::SNIPPET),
            default => Check::pass('C2', 10, 'ok', $replace),
        };
    }
}
