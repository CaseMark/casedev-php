<?php

namespace Casedev\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Permission Denied Exception';
}
