<?php

namespace CaseDev\Core\Exceptions;

class ConflictException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Conflict Exception';
}
