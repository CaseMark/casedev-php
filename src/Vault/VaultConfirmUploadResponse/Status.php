<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultConfirmUploadResponse;

enum Status: string
{
    case COMPLETED = 'completed';

    case FAILED = 'failed';
}
