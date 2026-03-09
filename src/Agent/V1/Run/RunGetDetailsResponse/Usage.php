<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse;

use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage\Entry;
use CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage\Summary;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Token usage statistics.
 *
 * @phpstan-import-type EntryShape from \CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage\Entry
 * @phpstan-import-type SummaryShape from \CaseDev\Agent\V1\Run\RunGetDetailsResponse\Usage\Summary
 *
 * @phpstan-type UsageShape = array{
 *   durationMs?: int|null,
 *   entries?: list<Entry|EntryShape>|null,
 *   inputTokens?: int|null,
 *   model?: string|null,
 *   outputTokens?: int|null,
 *   summary?: null|Summary|SummaryShape,
 *   toolCalls?: int|null,
 * }
 */
final class Usage implements BaseModel
{
    /** @use SdkModel<UsageShape> */
    use SdkModel;

    #[Optional]
    public ?int $durationMs;

    /** @var list<Entry>|null $entries */
    #[Optional(list: Entry::class)]
    public ?array $entries;

    #[Optional]
    public ?int $inputTokens;

    #[Optional]
    public ?string $model;

    #[Optional]
    public ?int $outputTokens;

    #[Optional(nullable: true)]
    public ?Summary $summary;

    #[Optional]
    public ?int $toolCalls;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Entry|EntryShape>|null $entries
     * @param Summary|SummaryShape|null $summary
     */
    public static function with(
        ?int $durationMs = null,
        ?array $entries = null,
        ?int $inputTokens = null,
        ?string $model = null,
        ?int $outputTokens = null,
        Summary|array|null $summary = null,
        ?int $toolCalls = null,
    ): self {
        $self = new self;

        null !== $durationMs && $self['durationMs'] = $durationMs;
        null !== $entries && $self['entries'] = $entries;
        null !== $inputTokens && $self['inputTokens'] = $inputTokens;
        null !== $model && $self['model'] = $model;
        null !== $outputTokens && $self['outputTokens'] = $outputTokens;
        null !== $summary && $self['summary'] = $summary;
        null !== $toolCalls && $self['toolCalls'] = $toolCalls;

        return $self;
    }

    public function withDurationMs(int $durationMs): self
    {
        $self = clone $this;
        $self['durationMs'] = $durationMs;

        return $self;
    }

    /**
     * @param list<Entry|EntryShape> $entries
     */
    public function withEntries(array $entries): self
    {
        $self = clone $this;
        $self['entries'] = $entries;

        return $self;
    }

    public function withInputTokens(int $inputTokens): self
    {
        $self = clone $this;
        $self['inputTokens'] = $inputTokens;

        return $self;
    }

    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    public function withOutputTokens(int $outputTokens): self
    {
        $self = clone $this;
        $self['outputTokens'] = $outputTokens;

        return $self;
    }

    /**
     * @param Summary|SummaryShape|null $summary
     */
    public function withSummary(Summary|array|null $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }

    public function withToolCalls(int $toolCalls): self
    {
        $self = clone $this;
        $self['toolCalls'] = $toolCalls;

        return $self;
    }
}
