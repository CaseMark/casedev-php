<?php

namespace Router\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Unprocessable Entity Exception';
}
