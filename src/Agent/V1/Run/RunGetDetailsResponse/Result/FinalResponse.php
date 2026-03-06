<?php

declare(strict_types=1);

namespace CaseDev\Agent\V1\Run\RunGetDetailsResponse\Result;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Compact agent-facing result summary and execution issues.
 *
 * @phpstan-type FinalResponseShape = array{
 *   createdObjectIDs?: list<string>|null,
 *   issues?: list<string>|null,
 *   summary?: string|null,
 * }
 */
final class FinalResponse implements BaseModel
{
    /** @use SdkModel<FinalResponseShape> */
    use SdkModel;

    /** @var list<string>|null $createdObjectIDs */
    #[Optional('createdObjectIds', list: 'string')]
    public ?array $createdObjectIDs;

    /** @var list<string>|null $issues */
    #[Optional(list: 'string')]
    public ?array $issues;

    #[Optional]
    public ?string $summary;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $createdObjectIDs
     * @param list<string>|null $issues
     */
    public static function with(
        ?array $createdObjectIDs = null,
        ?array $issues = null,
        ?string $summary = null
    ): self {
        $self = new self;

        null !== $createdObjectIDs && $self['createdObjectIDs'] = $createdObjectIDs;
        null !== $issues && $self['issues'] = $issues;
        null !== $summary && $self['summary'] = $summary;

        return $self;
    }

    /**
     * @param list<string> $createdObjectIDs
     */
    public function withCreatedObjectIDs(array $createdObjectIDs): self
    {
        $self = clone $this;
        $self['createdObjectIDs'] = $createdObjectIDs;

        return $self;
    }

    /**
     * @param list<string> $issues
     */
    public function withIssues(array $issues): self
    {
        $self = clone $this;
        $self['issues'] = $issues;

        return $self;
    }

    public function withSummary(string $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
