<?php

declare(strict_types=1);

namespace CaseDev\Vault\Objects\ObjectCreatePresignedURLParams;

/**
 * The S3 operation to generate URL for.
 */
enum Operation: string
{
    case GET = 'GET';

    case PUT = 'PUT';

    case DELETE = 'DELETE';

    case HEAD = 'HEAD';
}
