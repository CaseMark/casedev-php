<?php

declare(strict_types=1);

namespace CaseDev\Vault\VaultUploadResponse;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type InstructionsShape = array{
 *   headers?: mixed, method?: string|null, note?: string|null
 * }
 */
final class Instructions implements BaseModel
{
    /** @use SdkModel<InstructionsShape> */
    use SdkModel;

    #[Optional]
    public mixed $headers;

    #[Optional]
    public ?string $method;

    #[Optional]
    public ?string $note;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        mixed $headers = null,
        ?string $method = null,
        ?string $note = null
    ): self {
        $self = new self;

        null !== $headers && $self['headers'] = $headers;
        null !== $method && $self['method'] = $method;
        null !== $note && $self['note'] = $note;

        return $self;
    }

    public function withHeaders(mixed $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }

    public function withMethod(string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    public function withNote(string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }
}
