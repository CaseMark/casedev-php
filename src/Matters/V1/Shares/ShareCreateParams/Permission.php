<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Shares\ShareCreateParams;

enum Permission: string
{
    case READ = 'read';

    case EDIT = 'edit';
}
