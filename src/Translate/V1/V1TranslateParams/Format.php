<?php

declare(strict_types=1);

namespace CaseDev\Translate\V1\V1TranslateParams;

/**
 * Format of the source text. Use 'html' to preserve HTML tags.
 */
enum Format: string
{
    case TEXT = 'text';

    case HTML = 'html';
}
