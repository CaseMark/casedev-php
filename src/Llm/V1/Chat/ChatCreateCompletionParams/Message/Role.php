<?php

declare(strict_types=1);

namespace CaseDev\Llm\V1\Chat\ChatCreateCompletionParams\Message;

/**
 * The role of the message author.
 */
enum Role: string
{
    case SYSTEM = 'system';

    case USER = 'user';

    case ASSISTANT = 'assistant';
}
