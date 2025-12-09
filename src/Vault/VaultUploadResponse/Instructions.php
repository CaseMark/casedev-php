<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultUploadResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

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
        $obj = new self;

        null !== $headers && $obj['headers'] = $headers;
        null !== $method && $obj['method'] = $method;
        null !== $note && $obj['note'] = $note;

        return $obj;
    }

    public function withHeaders(mixed $headers): self
    {
        $obj = clone $this;
        $obj['headers'] = $headers;

        return $obj;
    }

    public function withMethod(string $method): self
    {
        $obj = clone $this;
        $obj['method'] = $method;

        return $obj;
    }

    public function withNote(string $note): self
    {
        $obj = clone $this;
        $obj['note'] = $note;

        return $obj;
    }
}
