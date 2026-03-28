<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\V1UpdateParams;

enum Status: string
{
    case INTAKE = 'intake';

    case OPEN = 'open';

    case PENDING = 'pending';

    case CLOSED = 'closed';

    case ARCHIVED = 'archived';
}
