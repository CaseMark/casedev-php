<?php

namespace CaseDev\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Rate Limit Exception';
}
