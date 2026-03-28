<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\WorkItems\WorkItemUpdateParams;

enum Type: string
{
    case TASK = 'task';

    case DEADLINE = 'deadline';

    case REVIEW = 'review';

    case FILING = 'filing';

    case COMMUNICATION = 'communication';

    case RESEARCH = 'research';

    case DRAFTING = 'drafting';

    case COLLECTION = 'collection';

    case INTAKE = 'intake';
}
