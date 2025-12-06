<?php

declare(strict_types=1);

namespace Casedev\Vault\VaultSearchResponse;

use Casedev\Core\Attributes\Api;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChunkShape = array{
 *   score?: float|null, source?: string|null, text?: string|null
 * }
 */
final class Chunk implements BaseModel
{
    /** @use SdkModel<ChunkShape> */
    use SdkModel;

    #[Api(optional: true)]
    public ?float $score;

    #[Api(optional: true)]
    public ?string $source;

    #[Api(optional: true)]
    public ?string $text;

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
        ?float $score = null,
        ?string $source = null,
        ?string $text = null
    ): self {
        $obj = new self;

        null !== $score && $obj['score'] = $score;
        null !== $source && $obj['source'] = $source;
        null !== $text && $obj['text'] = $text;

        return $obj;
    }

    public function withScore(float $score): self
    {
        $obj = clone $this;
        $obj['score'] = $score;

        return $obj;
    }

    public function withSource(string $source): self
    {
        $obj = clone $this;
        $obj['source'] = $source;

        return $obj;
    }

    public function withText(string $text): self
    {
        $obj = clone $this;
        $obj['text'] = $text;

        return $obj;
    }
}
