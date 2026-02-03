<?php

declare(strict_types=1);

namespace Casedev\Projects\V1\V1CreateParams;

enum SourceType: string
{
    case GITHUB = 'github';

    case THURGOOD = 'thurgood';
}
