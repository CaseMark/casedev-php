<?php

namespace CaseDev\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Bad Request Exception';
}
