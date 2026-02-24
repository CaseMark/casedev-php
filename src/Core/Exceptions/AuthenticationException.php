<?php

namespace CaseDev\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Authentication Exception';
}
