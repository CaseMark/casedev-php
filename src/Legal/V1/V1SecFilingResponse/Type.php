<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1SecFilingResponse;

enum Type: string
{
    case SEARCH = 'search';

    case ENTITY = 'entity';
}
