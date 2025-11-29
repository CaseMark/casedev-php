<?php

declare(strict_types=1);

namespace Casedev\Voice\V1\V1ListVoicesParams;

/**
 * Filter by voice type.
 */
enum VoiceType: string
{
    case PREMADE = 'premade';

    case CLONED = 'cloned';

    case PROFESSIONAL = 'professional';
}
