<?php

declare(strict_types=1);

namespace CaseDev\Memory\V1\V1CreateParams\Message;

/**
 * Message role.
 */
enum Role: string
{
    case USER = 'user';

    case ASSISTANT = 'assistant';

    case SYSTEM = 'system';
}
