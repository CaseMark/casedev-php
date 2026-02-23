<?php

namespace Router\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Authentication Exception';
}
