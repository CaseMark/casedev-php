<?php

namespace Router\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Bad Request Exception';
}
