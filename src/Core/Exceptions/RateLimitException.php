<?php

namespace Casedev\Core\Exceptions;

class RateLimitException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Rate Limit Exception';
}
