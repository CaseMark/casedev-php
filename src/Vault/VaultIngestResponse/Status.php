<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultIngestResponse;

/**
 * Current ingestion status. 'stored' for file types without text extraction (no chunks/vectors created).
 */
enum Status: string
{
    case PROCESSING = 'processing';

    case STORED = 'stored';
}
