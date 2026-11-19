<?php

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * L1: the headers do not tell the versions of the server and the platform, which make known holes easy to find.
 */
class VersionLeakCheck implements SiteCheck
{
    /** Headers servers and platforms put their names and versions into. */
    public const array HEADERS = ['Server', 'X-Powered-By', 'X-AspNet-Version', 'X-AspNetMvc-Version', 'X-Generator'];

    public const string SNIPPET = <<<'TEXT'
        # nginx (http block)
        server_tokens off;

        # Apache
        ServerTokens Prod
        ServerSignature Off

        # PHP (php.ini)
        expose_php = Off
        TEXT;

    public function run(Snapshot $site): Check
    {
        $leaks = [];
        foreach (self::HEADERS as $name) {
            $value = $site->header($name);

            if ($value !== null && preg_match('/\d+\.\d+/', $value)) {
                $leaks[] = $name.': '.$value;
            }
        }

        return $leaks === []
            ? Check::pass('L1', 5, 'ok')
            : Check::fail('L1', 5, 'leaks', evidence: $leaks, snippet: self::SNIPPET);
    }
}
