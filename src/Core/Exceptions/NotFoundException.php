<?php

namespace CaseDev\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Not Found Exception';
}
