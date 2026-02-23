<?php

declare(strict_types=1);

namespace Router\Superdoc\V1\V1ConvertParams;

/**
 * Target format for conversion.
 */
enum To: string
{
    case PDF = 'pdf';

    case DOCX = 'docx';
}
