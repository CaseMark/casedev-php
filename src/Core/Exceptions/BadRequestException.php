<?php

namespace Casedev\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Bad Request Exception';
}
