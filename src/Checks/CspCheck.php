<?php

declare(strict_types=1);

namespace Yu\SecurityCheck\Checks;

use Illuminate\Support\Str;
use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * H2: Content-Security-Policy limits where scripts may come from, the main defence against injected scripts (XSS).
 */
class CspCheck implements SiteCheck
{
    public const string SNIPPET = <<<'TEXT'
        # Start in report-only mode, look at the browser console, then switch to Content-Security-Policy
        # nginx
        add_header Content-Security-Policy-Report-Only "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; frame-ancestors 'self'; object-src 'none'; base-uri 'self'" always;

        # Apache
        Header always set Content-Security-Policy-Report-Only "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data: https:; frame-ancestors 'self'; object-src 'none'; base-uri 'self'"
        TEXT;

    public function run(Snapshot $site): Check
    {
        $policy = $site->header('content-security-policy');
        $reportOnly = $site->header('content-security-policy-report-only');

        if ($policy === null && $reportOnly !== null) {
            return Check::warn('H2', 3, 10, 'report_only', evidence: [$this->shorten($reportOnly)], snippet: self::SNIPPET);
        }

        if ($policy === null) {
            return Check::fail('H2', 10, 'none', snippet: self::SNIPPET);
        }

        $unsafe = array_values(array_filter(
            ["'unsafe-inline'", "'unsafe-eval'"],
            fn (string $keyword): bool => str_contains(strtolower($this->scriptSources($policy)), $keyword),
        ));

        if ($unsafe !== []) {
            return Check::warn('H2', 6, 10, 'unsafe', ['keywords' => implode(', ', $unsafe)], [$this->shorten($policy)], self::SNIPPET);
        }

        return Check::pass('H2', 10, 'ok', evidence: [$this->shorten($policy)]);
    }

    /**
     * The sources scripts may come from: script-src, or default-src when there is no script-src.
     */
    private function scriptSources(string $policy): string
    {
        $directives = [];
        foreach (explode(';', $policy) as $directive) {
            $words = preg_split('/\s+/', trim($directive), 2);
            $directives[strtolower($words[0])] ??= $words[1] ?? '';
        }

        return $directives['script-src'] ?? $directives['default-src'] ?? '';
    }

    private function shorten(string $policy): string
    {
        return Str::limit($policy, 300);
    }
}
