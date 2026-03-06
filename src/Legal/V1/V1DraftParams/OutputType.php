<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DraftParams;

/**
 * Output file format.
 */
enum OutputType: string
{
    case PDF = 'pdf';

    case DOCX = 'docx';

    case XLSX = 'xlsx';

    case PPTX = 'pptx';

    case MD = 'md';
}
