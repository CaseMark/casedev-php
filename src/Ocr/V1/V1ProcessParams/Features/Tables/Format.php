<?php

declare(strict_types=1);

namespace CaseDev\Ocr\V1\V1ProcessParams\Features\Tables;

/**
 * Output format for extracted tables.
 */
enum Format: string
{
    case CSV = 'csv';

    case JSON = 'json';
}
