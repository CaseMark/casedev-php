<?php

namespace Router\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Router Permission Denied Exception';
}
