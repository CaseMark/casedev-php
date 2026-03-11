<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Chat\ChatSendMessageParams\Part;

/**
 * Part type. Currently only "text" is supported.
 */
enum Type: string
{
    case TEXT = 'text';
}
