<?php

namespace CaseDev\Core\Exceptions;

class UnprocessableEntityException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Unprocessable Entity Exception';
}
