<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\V1DeployParams\Config;

/**
 * GPU type for acceleration.
 */
enum GPUType: string
{
    case CPU = 'cpu';

    case T4 = 'T4';

    case L4 = 'L4';

    case A10_G = 'A10G';

    case L40_S = 'L40S';

    case A100 = 'A100';

    case A100_40_GB = 'A100-40GB';

    case A100_80_GB = 'A100-80GB';

    case H100 = 'H100';

    case H200 = 'H200';

    case B200 = 'B200';
}
