<?php

declare(strict_types=1);

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * C3: the http:// address sends visitors to https://.
 */
class RedirectCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # nginx
        server {
            listen 80;
            server_name example.com www.example.com;
            return 301 https://$host$request_uri;
        }

        # Apache (.htaccess)
        RewriteEngine On
        RewriteCond %{HTTPS} off
        RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
        TEXT;

    public function run(Snapshot $site): Check
    {
        if ($site->httpLandsOn === null) {
            return Check::skip('C3', 10, 'no_http');
        }

        $evidence = ['http://'.$site->host.' → '.$site->httpLandsOn];

        return str_starts_with(strtolower($site->httpLandsOn), 'https://')
            ? Check::pass('C3', 10, 'ok', evidence: $evidence)
            : Check::fail('C3', 10, 'none', evidence: $evidence, snippet: self::SNIPPET);
    }
}
