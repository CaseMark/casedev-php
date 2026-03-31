<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems\WorkItemDecideParams;

enum Decision: string
{
    case APPROVE = 'approve';

    case REVISE = 'revise';

    case BLOCK = 'block';

    case REASSIGN = 'reassign';
}
