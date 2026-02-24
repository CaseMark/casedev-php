<?php

namespace CaseDev\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'CaseDev Internal Server Exception';
}
