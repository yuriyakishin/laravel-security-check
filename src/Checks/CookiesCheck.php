<?php

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * L2: the cookies the page sets go only over https (Secure), are hidden from scripts (HttpOnly)
 * and are not sent from other sites (SameSite). CSRF token cookies are read by scripts on purpose, so they may skip HttpOnly.
 */
class CookiesCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        Set-Cookie: session=…; Path=/; Secure; HttpOnly; SameSite=Lax

        # Laravel (.env)
        SESSION_SECURE_COOKIE=true
        SESSION_SAME_SITE=lax

        # PHP (php.ini)
        session.cookie_secure = 1
        session.cookie_httponly = 1
        session.cookie_samesite = Lax
        TEXT;

    public function run(Snapshot $site): Check
    {
        $cookies = $site->cookies();

        if ($cookies === []) {
            return Check::skip('L2', 10, 'none');
        }

        $insecure = false;
        $evidence = [];

        foreach ($cookies as $cookie) {
            [$name, $flags] = $this->parse($cookie);
            $missing = array_keys(array_filter([
                'Secure' => $site->isHttps() && !in_array('secure', $flags, true),
                'HttpOnly' => !in_array('httponly', $flags, true) && !preg_match('/csrf|xsrf/i', $name),
                'SameSite' => !in_array('samesite', $flags, true),
            ]));

            if ($missing !== []) {
                $insecure = $insecure || in_array('Secure', $missing, true);
                $evidence[] = $name.': '.implode(', ', $missing);
            }
        }

        $replace = ['count' => count($cookies)];

        return match (true) {
            $insecure => Check::fail('L2', 10, 'insecure', $replace, $evidence, self::SNIPPET),
            $evidence !== [] => Check::warn('L2', 5, 10, 'partial', $replace, $evidence, self::SNIPPET),
            default => Check::pass('L2', 10, 'ok', $replace),
        };
    }

    /**
     * The cookie name and the lower-case names of its attributes.
     *
     * @return array{0: string, 1: list<string>}
     */
    private function parse(string $cookie): array
    {
        $parts = array_map('trim', explode(';', $cookie));
        $name = trim(strstr($parts[0], '=', true) ?: $parts[0]);
        $flags = array_map(fn (string $part): string => strtolower(trim(strstr($part, '=', true) ?: $part)), array_slice($parts, 1));

        return [$name, $flags];
    }
}
