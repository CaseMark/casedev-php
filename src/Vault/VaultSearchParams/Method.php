<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultSearchParams;

/**
 * Search method: 'global' for comprehensive questions, 'entity' for specific entities, 'fast' for quick similarity search, 'hybrid' for combined approach.
 */
enum Method: string
{
    case VECTOR = 'vector';

    case GRAPH = 'graph';

    case HYBRID = 'hybrid';

    case GLOBAL = 'global';

    case LOCAL = 'local';

    case FAST = 'fast';

    case ENTITY = 'entity';
}
