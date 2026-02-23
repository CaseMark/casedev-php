<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1ListJurisdictionsResponse\Jurisdiction;

/**
 * Jurisdiction level.
 */
enum Level: string
{
    case FEDERAL = 'federal';

    case STATE = 'state';

    case COUNTY = 'county';

    case MUNICIPAL = 'municipal';
}
