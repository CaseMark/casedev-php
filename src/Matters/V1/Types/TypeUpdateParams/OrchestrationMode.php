<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Types\TypeUpdateParams;

enum OrchestrationMode: string
{
    case AUTO = 'auto';

    case HUMAN = 'human';
}
