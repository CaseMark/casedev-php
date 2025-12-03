<?php

declare(strict_types=1);

namespace Casedev\Workflows\V1\V1UpdateParams;

enum TriggerType: string
{
    case MANUAL = 'manual';

    case WEBHOOK = 'webhook';

    case SCHEDULE = 'schedule';

    case VAULT_UPLOAD = 'vault_upload';
}
