<?php

declare(strict_types=1);

namespace CaseDev\Search\V1;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type V1ResearchResponseShape = array{
 *   model?: string|null, researchID?: string|null, results?: mixed
 * }
 */
final class V1ResearchResponse implements BaseModel
{
    /** @use SdkModel<V1ResearchResponseShape> */
    use SdkModel;

    /**
     * Model used for research.
     */
    #[Optional]
    public ?string $model;

    /**
     * Unique identifier for this research.
     */
    #[Optional('researchId')]
    public ?string $researchID;

    /**
     * Research findings and analysis.
     */
    #[Optional]
    public mixed $results;

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
        ?string $model = null,
        ?string $researchID = null,
        mixed $results = null
    ): self {
        $self = new self;

        null !== $model && $self['model'] = $model;
        null !== $researchID && $self['researchID'] = $researchID;
        null !== $results && $self['results'] = $results;

        return $self;
    }

    /**
     * Model used for research.
     */
    public function withModel(string $model): self
    {
        $self = clone $this;
        $self['model'] = $model;

        return $self;
    }

    /**
     * Unique identifier for this research.
     */
    public function withResearchID(string $researchID): self
    {
        $self = clone $this;
        $self['researchID'] = $researchID;

        return $self;
    }

    /**
     * Research findings and analysis.
     */
    public function withResults(mixed $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
