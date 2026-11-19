<?php

namespace Yu\SecurityCheck\Services;

use Yu\SecurityCheck\Checks;
use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\ChecklistReport;

/**
 * Collects the certificate and the headers of the site and runs the checks.
 */
class SecurityAnalyzer
{
    /**
     * Checks by group, in the order of the report: C — certificate and https, H — security headers, L — leaks and cookies.
     * The letter codes are internal keys of the translations, the report never shows them.
     */
    public const array GROUPS = [
        'C' => [Checks\CertificateCheck::class, Checks\ExpiryCheck::class, Checks\RedirectCheck::class, Checks\ProtocolCheck::class],
        'H' => [Checks\HstsCheck::class, Checks\CspCheck::class, Checks\FramingCheck::class, Checks\NosniffCheck::class, Checks\ReferrerCheck::class, Checks\PermissionsCheck::class],
        'L' => [Checks\VersionLeakCheck::class, Checks\CookiesCheck::class],
    ];

    public function __construct(private SnapshotCollector $collector) {}

    /**
     * The checklist report with the certificate under the key "certificate" (null when there is no https).
     *
     * @return array<string, mixed>
     */
    public function analyze(string $url, string $locale): array
    {
        $site = $this->collector->collect($url);

        return [...$this->report($site, $locale)->toArray(), 'certificate' => $site->certificate?->toArray()];
    }

    public function report(Snapshot $site, string $locale): ChecklistReport
    {
        $groups = [];
        foreach (self::GROUPS as $group => $checks) {
            $groups[$group] = array_map(fn (string $check) => app($check)->run($site), $checks);
        }

        return new ChecklistReport(
            url: $site->page->url,
            locale: $locale,
            checkedAt: now()->toIso8601String(),
            ruleset: (string) config('security-check.ruleset'),
            groups: $groups,
        );
    }
}
