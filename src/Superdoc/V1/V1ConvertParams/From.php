<?php

declare(strict_types=1);

namespace CaseDev\Superdoc\V1\V1ConvertParams;

/**
 * Source format of the document.
 */
enum From: string
{
    case DOCX = 'docx';

    case MD = 'md';

    case HTML = 'html';
}
