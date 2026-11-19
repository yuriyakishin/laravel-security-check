<?php

declare(strict_types=1);

namespace Yu\SecurityCheck\Data;

use Yu\WebToolsCore\Http\Certificate;
use Yu\WebToolsCore\Http\Resource;

/**
 * Everything the checks need: the certificate of the host, the page with its headers and where http:// leads.
 */
final readonly class Snapshot
{
    /**
     * @param  Certificate|null  $certificate  null when the host does not answer TLS on port 443
     * @param  resource  $page  the page over https, or over http when https does not open
     * @param  string|null  $httpLandsOn  the final address of the http:// version; null when http does not answer
     */
    public function __construct(
        public string $host,
        public ?Certificate $certificate,
        public Resource $page,
        public ?string $httpLandsOn = null,
    ) {}

    public function header(string $name): ?string
    {
        $value = $this->page->header($name);

        return $value === null || trim($value) === '' ? null : trim($value);
    }

    public function isHttps(): bool
    {
        return str_starts_with(strtolower($this->page->url), 'https://');
    }

    /**
     * The Set-Cookie headers of the page, one cookie per item.
     *
     * @return list<string>
     */
    public function cookies(): array
    {
        return array_values(array_filter(array_map('trim', explode("\n", $this->header('set-cookie') ?? ''))));
    }
}
