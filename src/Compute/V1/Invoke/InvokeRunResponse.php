<?php

declare(strict_types=1);

namespace Casedev\Compute\V1\Invoke;

use Casedev\Compute\V1\Invoke\InvokeRunResponse\AsynchronousResponse;
use Casedev\Compute\V1\Invoke\InvokeRunResponse\SynchronousResponse;
use Casedev\Core\Concerns\SdkUnion;
use Casedev\Core\Conversion\Contracts\Converter;
use Casedev\Core\Conversion\Contracts\ConverterSource;

final class InvokeRunResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [SynchronousResponse::class, AsynchronousResponse::class];
    }
}
