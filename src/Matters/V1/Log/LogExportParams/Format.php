<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Log\LogExportParams;

/**
 * Export format. Defaults to jsonl.
 */
enum Format: string
{
    case JSON = 'json';

    case JSONL = 'jsonl';

    case CSV = 'csv';

    case TSV = 'tsv';
}
