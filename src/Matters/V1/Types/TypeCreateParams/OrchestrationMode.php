<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Types\TypeCreateParams;

enum OrchestrationMode: string
{
    case AUTO = 'auto';

    case HUMAN = 'human';
}
