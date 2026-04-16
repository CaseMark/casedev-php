<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse;

/**
 * Runtime provider for this run.
 */
enum Provider: string
{
    case DAYTONA = 'daytona';

    case VERCEL = 'vercel';
}
