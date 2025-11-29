<?php

namespace Casedev\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Conflict Exception';
}
