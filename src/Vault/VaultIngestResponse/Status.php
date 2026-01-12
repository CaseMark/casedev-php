<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultIngestResponse;

/**
 * Current ingestion status. 'stored' for file types without text extraction (no chunks/vectors created).
 */
enum Status: string
{
    case PROCESSING = 'processing';

    case STORED = 'stored';
}
