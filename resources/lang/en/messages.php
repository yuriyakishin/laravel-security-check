<?php

return [
    'form' => [
        'label' => 'Site address',
        'button' => 'Check',
        'hint' => 'Free · no sign-up · up to :count checks per hour',
    ],
    'loading' => [
        'certificate' => 'Reading the SSL certificate',
        'headers' => 'Loading the page headers',
        'checks' => 'Checking the security settings',
    ],
    'verdicts' => [
        'ready' => 'The site is well protected',
        'almost' => 'The site is almost well protected',
        'partly' => 'The site\'s protection needs work',
        'not_ready' => 'The site is poorly protected',
    ],
    'certificate' => [
        'title' => 'SSL certificate',
        'issuer' => 'Issued by',
        'valid_to' => 'Valid until',
        'days_left' => ':days days left',
        'protocol' => 'Connection',
        'names' => 'Domains',
        'none' => 'The site does not open over https: there is no certificate on port 443.',
    ],
    'groups' => [
        'C' => ['title' => 'Certificate and https', 'text' => 'Whether the connection to the site is encrypted and trusted'],
        'H' => ['title' => 'Security headers', 'text' => 'Server headers that tell the browser how to protect visitors'],
        'L' => ['title' => 'Leaks and cookies', 'text' => 'What the server tells about itself and how it stores cookies'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Do browsers trust the certificate?',
            'text' => 'A valid certificate for this domain',
            'fix' => 'Install a certificate for this domain from a known authority. Let\'s Encrypt gives one for free and renews it automatically. Most hosting panels have a "free SSL" button.',
            'notes' => [
                'ok' => 'The certificate is trusted, issued by :issuer.',
                'none' => 'The site does not open over https. Browsers mark it "Not secure" and data goes unencrypted.',
                'expired' => 'The certificate expired on :date. Browsers show a full-page warning.',
                'name_mismatch' => 'The certificate is issued for other domains, not :host. Browsers show a warning.',
                'untrusted' => 'Browsers do not trust the certificate (:issuer): it is self-signed or the intermediate certificates are missing.',
            ],
        ],
        'C2' => [
            'title' => 'Will the certificate run out soon?',
            'text' => 'At least 30 days left',
            'fix' => 'Renew the certificate and make sure renewal is automatic: Let\'s Encrypt certificates live 90 days, and automatic renewal often breaks silently.',
            'notes' => [
                'ok' => 'Valid until :date, :days days left.',
                'soon' => 'Only :days days left, until :date. Make sure it renews automatically.',
                'urgent' => 'Only :days days left, until :date. Renew it now.',
                'expired' => 'The certificate expired on :date.',
                'none' => 'There is no certificate to check.',
            ],
        ],
        'C3' => [
            'title' => 'Does http:// lead to https://?',
            'text' => 'A redirect from http to https',
            'fix' => 'Set up a permanent (301) redirect from every http:// address to the same https:// address.',
            'notes' => [
                'ok' => 'The http:// address leads to https://.',
                'none' => 'The http:// address opens without encryption: visitors who type the address by hand stay on the insecure version.',
                'no_http' => 'The site does not answer over http://, so there is nothing to redirect.',
            ],
        ],
        'C4' => [
            'title' => 'Is the connection modern?',
            'text' => 'TLS 1.2 or 1.3',
            'fix' => 'Turn on TLS 1.2 and 1.3 in the server settings and turn off the old versions: browsers no longer open sites on TLS 1.0 and 1.1.',
            'notes' => [
                'ok' => 'The connection uses :protocol.',
                'old' => 'The connection uses :protocol, an outdated version.',
                'none' => 'There is no https connection to check.',
            ],
        ],
        'H1' => [
            'title' => 'Does the browser always use https?',
            'text' => 'Strict-Transport-Security for at least 6 months',
            'fix' => 'Add the Strict-Transport-Security header with max-age of at least half a year (a year is better) and includeSubDomains. Then the browser opens the site only over https, even from an old http:// link.',
            'notes' => [
                'ok' => 'HSTS is on for :days days, subdomains included.',
                'none' => 'There is no HSTS header: the first visit over http:// can be intercepted.',
                'short' => 'HSTS is on for only :days days. Set at least 180 days.',
                'no_subdomains' => 'HSTS does not cover subdomains: add includeSubDomains.',
                'no_https' => 'The site does not open over https, so HSTS cannot work.',
            ],
        ],
        'H2' => [
            'title' => 'Are scripts limited?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Add Content-Security-Policy with the list of sources scripts, styles and images may come from. Start with Content-Security-Policy-Report-Only to see what would break, then switch it on.',
            'notes' => [
                'ok' => 'There is a policy without unsafe-inline and unsafe-eval for scripts.',
                'none' => 'There is no Content-Security-Policy: an injected script (XSS) can run without limits.',
                'report_only' => 'The policy is in report-only mode: it reports violations but blocks nothing.',
                'unsafe' => 'The policy allows :keywords for scripts, which removes most of its protection against XSS.',
            ],
        ],
        'H3' => [
            'title' => 'Can other sites show the page in a frame?',
            'text' => 'X-Frame-Options or frame-ancestors',
            'fix' => 'Add X-Frame-Options: SAMEORIGIN, or frame-ancestors \'self\' in Content-Security-Policy, so that other sites cannot put the page under a fake button (clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options forbids frames on other sites.',
                'csp' => 'frame-ancestors in Content-Security-Policy controls frames.',
                'none' => 'Any site can show the page in a frame.',
                'invalid' => 'An outdated or unknown X-Frame-Options value: browsers ignore it.',
            ],
        ],
        'H4' => [
            'title' => 'Does the browser guess file types?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Add X-Content-Type-Options: nosniff so that the browser does not run a file as a script when the server says it is something else.',
            'notes' => [
                'ok' => 'nosniff is on.',
                'none' => 'There is no X-Content-Type-Options header.',
                'invalid' => 'An unknown value: the only valid one is nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Do page addresses leak to other sites?',
            'text' => 'Referrer-Policy',
            'fix' => 'Add Referrer-Policy: strict-origin-when-cross-origin: other sites get only the domain, without the page address and its parameters.',
            'notes' => [
                'ok' => 'The policy is set.',
                'none' => 'There is no Referrer-Policy header; the browser uses its default.',
                'leaky' => 'The policy sends full page addresses to other sites, parameters and tokens included.',
            ],
        ],
        'H6' => [
            'title' => 'Are unused browser features off?',
            'text' => 'Permissions-Policy',
            'fix' => 'Add Permissions-Policy and turn off what the site does not use: camera, microphone, location, payments. Then even an injected script cannot ask for them.',
            'notes' => [
                'ok' => 'The policy is set.',
                'none' => 'There is no Permissions-Policy header.',
                'legacy' => 'There is only the old Feature-Policy header: browsers have replaced it with Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => 'Does the server tell its version?',
            'text' => 'Server and X-Powered-By without versions',
            'fix' => 'Hide the versions of the server, PHP and the platform in the headers: with them, bots find sites with known holes in seconds.',
            'notes' => [
                'ok' => 'The headers do not tell any versions.',
                'leaks' => 'The headers tell the versions of the software.',
            ],
        ],
        'L2' => [
            'title' => 'Are the cookies protected?',
            'text' => 'Secure, HttpOnly and SameSite flags',
            'fix' => 'Set Secure on every cookie so it goes only over https, HttpOnly so scripts cannot read it, and SameSite=Lax so other sites do not send it.',
            'notes' => [
                'ok' => 'All :count cookies have the protective flags.',
                'insecure' => 'Some of the :count cookies have no Secure flag and can go over an unencrypted connection.',
                'partial' => 'Some of the :count cookies lack HttpOnly or SameSite.',
                'none' => 'The page sets no cookies.',
            ],
        ],
    ],
];
