<?php

declare(strict_types=1);

namespace CaseDev\Voice\BoostList\BoostListExtractResponse\Item;

enum BoostParam: string
{
    case LOW = 'low';

    case DEFAULT = 'default';

    case HIGH = 'high';
}
