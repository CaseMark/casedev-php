<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultConfirmUploadResponse;

enum Status: string
{
    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
