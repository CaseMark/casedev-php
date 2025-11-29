<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultIngestResponse;

/**
 * Current ingestion status.
 */
enum Status: string
{
    case PROCESSING = 'processing';
}
