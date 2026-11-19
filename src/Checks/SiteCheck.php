<?php

declare(strict_types=1);

namespace Yu\SecurityCheck\Checks;

use Yu\SecurityCheck\Data\Snapshot;
use Yu\WebToolsCore\Checklist\Check;

/**
 * One rule of the report. Its title, description and advice are translations under messages.checks.{code}.
 */
interface SiteCheck
{
    public function run(Snapshot $site): Check;
}
