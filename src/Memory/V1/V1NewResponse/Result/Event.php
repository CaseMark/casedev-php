<?php

declare(strict_types=1);

namespace Router\Memory\V1\V1NewResponse\Result;

/**
 * What happened to this memory.
 */
enum Event: string
{
    case ADD = 'ADD';

    case UPDATE = 'UPDATE';

    case DELETE = 'DELETE';

    case NONE = 'NONE';
}
