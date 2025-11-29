<?php

namespace Casedev\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Authentication Exception';
}
