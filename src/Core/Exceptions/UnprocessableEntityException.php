<?php

namespace Casedev\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Unprocessable Entity Exception';
}
