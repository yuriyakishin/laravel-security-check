<?php

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * C4: the connection uses TLS 1.2 or 1.3. It is the best version both sides support,
 * so the check shows that a modern version is on, not that the old ones are off.
 */
class ProtocolCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # nginx
        ssl_protocols TLSv1.2 TLSv1.3;

        # Apache
        SSLProtocol -all +TLSv1.2 +TLSv1.3
        TEXT;

    public function run(Snapshot $site): Check
    {
        $protocol = $site->certificate?->protocol;

        if ($protocol === null || $protocol === '') {
            return Check::skip('C4', 5, 'none');
        }

        return in_array($protocol, ['TLSv1.2', 'TLSv1.3'], true)
            ? Check::pass('C4', 5, 'ok', ['protocol' => $protocol])
            : Check::fail('C4', 5, 'old', ['protocol' => $protocol], snippet: self::SNIPPET);
    }
}
