<?php

namespace Casedev\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Casedev Not Found Exception';
}
