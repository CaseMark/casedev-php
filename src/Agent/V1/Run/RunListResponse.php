<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run;

use CaseDev\Agent\V1\Run\RunListResponse\Run;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type RunShape from \CaseDev\Agent\V1\Run\RunListResponse\Run
 *
 * @phpstan-type RunListResponseShape = array{
 *   hasMore?: bool|null, nextCursor?: string|null, runs?: list<Run|RunShape>|null
 * }
 */
final class RunListResponse implements BaseModel
{
    /** @use SdkModel<RunListResponseShape> */
    use SdkModel;

    #[Optional]
    public ?bool $hasMore;

    /**
     * Pass as cursor to fetch the next page.
     */
    #[Optional(nullable: true)]
    public ?string $nextCursor;

    /** @var list<Run>|null $runs */
    #[Optional(list: Run::class)]
    public ?array $runs;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Run|RunShape>|null $runs
     */
    public static function with(
        ?bool $hasMore = null,
        ?string $nextCursor = null,
        ?array $runs = null
    ): self {
        $self = new self;

        null !== $hasMore && $self['hasMore'] = $hasMore;
        null !== $nextCursor && $self['nextCursor'] = $nextCursor;
        null !== $runs && $self['runs'] = $runs;

        return $self;
    }

    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    /**
     * Pass as cursor to fetch the next page.
     */
    public function withNextCursor(?string $nextCursor): self
    {
        $self = clone $this;
        $self['nextCursor'] = $nextCursor;

        return $self;
    }

    /**
     * @param list<Run|RunShape> $runs
     */
    public function withRuns(array $runs): self
    {
        $self = clone $this;
        $self['runs'] = $runs;

        return $self;
    }
}
