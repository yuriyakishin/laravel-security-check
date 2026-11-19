<?php

declare(strict_types=1);

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * C1: the site has a certificate browsers trust, issued for this very domain.
 */
class CertificateCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # A free Let's Encrypt certificate with automatic renewal (nginx; for Apache use --apache)
        sudo apt install certbot python3-certbot-nginx
        sudo certbot --nginx -d example.com -d www.example.com
        TEXT;

    public function run(Snapshot $site): Check
    {
        $certificate = $site->certificate;

        if ($certificate === null) {
            return Check::fail('C1', 15, 'none', snippet: self::SNIPPET);
        }

        $names = array_slice($certificate->names, 0, 10);

        if ($certificate->trusted) {
            return Check::pass('C1', 15, 'ok', ['issuer' => $certificate->issuer], $names);
        }

        if ($certificate->isExpired()) {
            return Check::fail('C1', 15, 'expired', ['date' => date('Y-m-d', $certificate->validTo)], $names, self::SNIPPET);
        }

        if (!$certificate->covers($site->host)) {
            return Check::fail('C1', 15, 'name_mismatch', ['host' => $site->host], $names, self::SNIPPET);
        }

        return Check::fail('C1', 15, 'untrusted', ['issuer' => $certificate->issuer], $names, self::SNIPPET);
    }
}
