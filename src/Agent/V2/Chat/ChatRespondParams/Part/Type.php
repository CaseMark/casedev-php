<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat\ChatRespondParams\Part;

/**
 * Part type. Currently only "text" is supported.
 */
enum Type: string
{
    case TEXT = 'text';
}
