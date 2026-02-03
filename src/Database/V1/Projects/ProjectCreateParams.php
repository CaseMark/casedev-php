<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Database\V1\Projects\ProjectCreateParams\Region;

/**
 * Creates a new serverless Postgres database project powered by Neon. Includes automatic scaling, connection pooling, and a default 'main' branch with 'neondb' database. Supports branching for isolated dev/staging environments. Perfect for case management applications, document workflows, and litigation support systems.
 *
 * @see Casedev\Services\Database\V1\ProjectsService::create()
 *
 * @phpstan-type ProjectCreateParamsShape = array{
 *   name: string, description?: string|null, region?: null|Region|value-of<Region>
 * }
 */
final class ProjectCreateParams implements BaseModel
{
    /** @use SdkModel<ProjectCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project name (letters, numbers, hyphens, underscores only).
     */
    #[Required]
    public string $name;

    /**
     * Optional project description.
     */
    #[Optional]
    public ?string $description;

    /**
     * AWS region for database deployment.
     *
     * @var value-of<Region>|null $region
     */
    #[Optional(enum: Region::class)]
    public ?string $region;

    /**
     * `new ProjectCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectCreateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectCreateParams)->withName(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Region|value-of<Region>|null $region
     */
    public static function with(
        string $name,
        ?string $description = null,
        Region|string|null $region = null
    ): self {
        $self = new self;

        $self['name'] = $name;

        null !== $description && $self['description'] = $description;
        null !== $region && $self['region'] = $region;

        return $self;
    }

    /**
     * Project name (letters, numbers, hyphens, underscores only).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Optional project description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * AWS region for database deployment.
     *
     * @param Region|value-of<Region> $region
     */
    public function withRegion(Region|string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }
}
