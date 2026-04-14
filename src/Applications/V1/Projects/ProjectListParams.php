<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Lists application projects for the authenticated organization. Use enrich=true to include additional hosting metadata for projects linked to Vercel.
 *
 * @see CaseDev\Services\Applications\V1\ProjectsService::list()
 *
 * @phpstan-type ProjectListParamsShape = array{
 *   enrich?: bool|null, limit?: float|null
 * }
 */
final class ProjectListParams implements BaseModel
{
    /** @use SdkModel<ProjectListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Whether to include additional hosting metadata from Vercel.
     */
    #[Optional]
    public ?bool $enrich;

    /**
     * Maximum number of projects to return from each backing source.
     */
    #[Optional]
    public ?float $limit;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $enrich = null, ?float $limit = null): self
    {
        $self = new self;

        null !== $enrich && $self['enrich'] = $enrich;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Whether to include additional hosting metadata from Vercel.
     */
    public function withEnrich(bool $enrich): self
    {
        $self = clone $this;
        $self['enrich'] = $enrich;

        return $self;
    }

    /**
     * Maximum number of projects to return from each backing source.
     */
    public function withLimit(float $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
