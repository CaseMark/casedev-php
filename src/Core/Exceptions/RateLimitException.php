<?php

namespace Router\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Rate Limit Exception';
}
