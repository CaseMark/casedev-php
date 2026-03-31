<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Log;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Core\Conversion\MapOf;

/**
 * @phpstan-type LogExportResponseShape = array{
 *   data?: list<array<string,mixed>>|null
 * }
 */
final class LogExportResponse implements BaseModel
{
    /** @use SdkModel<LogExportResponseShape> */
    use SdkModel;

    /** @var list<array<string,mixed>>|null $data */
    #[Optional(list: new MapOf('mixed'))]
    public ?array $data;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<array<string,mixed>>|null $data
     */
    public static function with(?array $data = null): self
    {
        $self = new self;

        null !== $data && $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<array<string,mixed>> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
