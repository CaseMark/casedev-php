<?php

declare(strict_types=1);

namespace Router\Format\V1\V1CreateDocumentParams;

/**
 * Format of the input content.
 */
enum InputFormat: string
{
    case MD = 'md';

    case JSON = 'json';

    case TEXT = 'text';
}
