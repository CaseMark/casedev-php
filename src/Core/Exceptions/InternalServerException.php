<?php

namespace Router\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Internal Server Exception';
}
