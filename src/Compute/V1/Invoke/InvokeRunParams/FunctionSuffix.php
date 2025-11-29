<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke\InvokeRunParams;

/**
 * Override the auto-detected function suffix.
 */
enum FunctionSuffix: string
{
    case _MODAL = '_modal';

    case _TASK = '_task';

    case _WEB = '_web';

    case _SERVER = '_server';
}
