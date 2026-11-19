<?php

namespace Yu\SecurityCheck\Services;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Exceptions\ToolException;
use Yu\WebToolsCore\Http\Resource;
use Yu\WebToolsCore\Http\SafeFetcher;
use Yu\WebToolsCore\Http\TlsInspector;

/**
 * Reads the certificate of the host, the page over https and the http:// version of the same address.
 */
class SnapshotCollector
{
    public function __construct(private SafeFetcher $fetcher, private TlsInspector $tls) {}

    /**
     * @throws ToolException when the address is not allowed or the site opens neither over https nor over http
     */
    public function collect(string $url): Snapshot
    {
        $parts = parse_url($url);
        $host = strtolower($parts['host'] ?? '');

        if ($host === '') {
            throw new ToolException('invalid_url');
        }

        $path = ($parts['path'] ?? '/').(isset($parts['query']) ? '?'.$parts['query'] : '');
        $certificate = $this->tls->inspect($host);
        $https = $this->page('https://'.$host.$path);
        $http = $this->page('http://'.$host.$path);

        if ($https instanceof ToolException && $http instanceof ToolException) {
            throw $https;
        }

        return new Snapshot(
            host: $host,
            certificate: $certificate,
            page: $https instanceof Resource ? $https : $http,
            httpLandsOn: $http instanceof Resource ? $http->url : null,
        );
    }

    /**
     * The page of any status and type; a failure is returned, since the other scheme may still open.
     */
    private function page(string $url): Resource|ToolException
    {
        try {
            return $this->fetcher->fetch($url, null, (int) config('security-check.fetch.page_bytes'), 'text/html,application/xhtml+xml');
        } catch (ToolException $e) {
            if (in_array($e->reason, ['invalid_url', 'blocked_host'], true)) {
                throw $e;
            }

            return $e;
        }
    }
}
