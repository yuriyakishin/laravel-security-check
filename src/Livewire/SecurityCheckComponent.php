<?php

namespace Yu\SecurityCheck\Livewire;

use Illuminate\Contracts\View\View;
use Yu\SecurityCheck\Services\SecurityAnalyzer;
use Yu\WebToolsCore\Livewire\ToolComponent;
use Yu\WebToolsCore\Locale\LocaleResolver;

/**
 * The SSL and security headers check: the form, the loading log, the certificate summary and the checklist report.
 */
class SecurityCheckComponent extends ToolComponent
{
    protected function name(): string
    {
        return 'security-check';
    }

    protected function locales(): LocaleResolver
    {
        return new LocaleResolver(dirname(__DIR__, 2).'/resources/lang');
    }

    protected function run(string $url, string $locale): array
    {
        return app(SecurityAnalyzer::class)->analyze($url, $locale);
    }

    public function render(): View
    {
        return view('security-check::security-check');
    }
}
