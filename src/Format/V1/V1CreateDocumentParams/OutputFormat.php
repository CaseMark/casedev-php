<?php

declare(strict_types=1);

namespace CaseDev\Format\V1\V1CreateDocumentParams;

/**
 * Desired output format.
 */
enum OutputFormat: string
{
    case PDF = 'pdf';

    case DOCX = 'docx';

    case HTML_PREVIEW = 'html_preview';
}
