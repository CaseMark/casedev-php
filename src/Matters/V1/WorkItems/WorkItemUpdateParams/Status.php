<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams;

enum Status: string
{
    case DRAFT = 'draft';

    case QUEUED = 'queued';

    case IN_PROGRESS = 'in_progress';

    case BLOCKED = 'blocked';

    case IN_REVIEW = 'in_review';

    case AWAITING_HUMAN = 'awaiting_human';

    case DONE = 'done';

    case CANCELED = 'canceled';
}
