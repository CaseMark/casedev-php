<?php

namespace Casedev\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Internal Server Exception';
}
