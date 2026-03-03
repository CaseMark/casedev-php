<?php

declare(strict_types=1);

namespace CaseDev\Legal\V1\V1DocketResponse;

enum Type: string
{
    case SEARCH = 'search';

    case LOOKUP = 'lookup';
}
