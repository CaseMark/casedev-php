<?php

declare(strict_types=1);

namespace Casedev\Voice\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Voice\V1\V1ListVoicesResponse\Voice;

/**
 * @phpstan-import-type VoiceShape from \Casedev\Voice\V1\V1ListVoicesResponse\Voice
 *
 * @phpstan-type V1ListVoicesResponseShape = array{
 *   nextPageToken?: string|null,
 *   totalCount?: int|null,
 *   voices?: list<Voice|VoiceShape>|null,
 * }
 */
final class V1ListVoicesResponse implements BaseModel
{
    /** @use SdkModel<V1ListVoicesResponseShape> */
    use SdkModel;

    /**
     * Token for next page of results.
     */
    #[Optional('next_page_token')]
    public ?string $nextPageToken;

    /**
     * Total number of voices (if requested).
     */
    #[Optional('total_count')]
    public ?int $totalCount;

    /** @var list<Voice>|null $voices */
    #[Optional(list: Voice::class)]
    public ?array $voices;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Voice|VoiceShape>|null $voices
     */
    public static function with(
        ?string $nextPageToken = null,
        ?int $totalCount = null,
        ?array $voices = null
    ): self {
        $self = new self;

        null !== $nextPageToken && $self['nextPageToken'] = $nextPageToken;
        null !== $totalCount && $self['totalCount'] = $totalCount;
        null !== $voices && $self['voices'] = $voices;

        return $self;
    }

    /**
     * Token for next page of results.
     */
    public function withNextPageToken(string $nextPageToken): self
    {
        $self = clone $this;
        $self['nextPageToken'] = $nextPageToken;

        return $self;
    }

    /**
     * Total number of voices (if requested).
     */
    public function withTotalCount(int $totalCount): self
    {
        $self = clone $this;
        $self['totalCount'] = $totalCount;

        return $self;
    }

    /**
     * @param list<Voice|VoiceShape> $voices
     */
    public function withVoices(array $voices): self
    {
        $self = clone $this;
        $self['voices'] = $voices;

        return $self;
    }
}
