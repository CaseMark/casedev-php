<?php

declare(strict_types=1);

namespace Router\Superdoc\V1\V1AnnotateParams;

/**
 * Output format for the annotated document.
 */
enum OutputFormat: string
{
    case DOCX = 'docx';

    case PDF = 'pdf';
}
