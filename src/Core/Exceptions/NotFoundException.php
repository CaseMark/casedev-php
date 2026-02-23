<?php

namespace Router\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Not Found Exception';
}
