<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1PatentSearchParams;

/**
 * Filter by application type.
 */
enum ApplicationType: string
{
    case UTILITY = 'Utility';

    case DESIGN = 'Design';

    case PLANT = 'Plant';

    case PROVISIONAL = 'Provisional';

    case REISSUE = 'Reissue';
}
