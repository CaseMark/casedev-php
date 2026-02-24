<?php

namespace CaseDev\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Permission Denied Exception';
}
