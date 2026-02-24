<?php

declare(strict_types=1);

namespace CaseDev\Superdoc\V1\V1AnnotateParams\Field;

/**
 * Field data type.
 */
enum Type: string
{
    case TEXT = 'text';

    case IMAGE = 'image';

    case DATE = 'date';

    case NUMBER = 'number';
}
