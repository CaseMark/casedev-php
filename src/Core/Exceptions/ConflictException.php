<?php

namespace Router\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Conflict Exception';
}
