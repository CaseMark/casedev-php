<?php

namespace CaseDev\Core\Exceptions;

class CaseDevException extends \Exception
{
    /** @var string */
    protected const DESC = 'CaseDev Error';

    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($this::DESC.PHP_EOL.$message, $code, $previous);
    }
}
