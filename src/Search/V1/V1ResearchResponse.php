<?php

declare(strict_types=1);

namespace Casedev\Search\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;

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
        $obj = new self;

        null !== $model && $obj['model'] = $model;
        null !== $researchID && $obj['researchID'] = $researchID;
        null !== $results && $obj['results'] = $results;

        return $obj;
    }

    /**
     * Model used for research.
     */
    public function withModel(string $model): self
    {
        $obj = clone $this;
        $obj['model'] = $model;

        return $obj;
    }

    /**
     * Unique identifier for this research.
     */
    public function withResearchID(string $researchID): self
    {
        $obj = clone $this;
        $obj['researchID'] = $researchID;

        return $obj;
    }

    /**
     * Research findings and analysis.
     */
    public function withResults(mixed $results): self
    {
        $obj = clone $this;
        $obj['results'] = $results;

        return $obj;
    }
}
