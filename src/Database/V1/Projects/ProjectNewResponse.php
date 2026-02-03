<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Database\V1\Projects\ProjectNewResponse\DefaultBranch;
use Casedev\Database\V1\Projects\ProjectNewResponse\Status;

/**
 * @phpstan-import-type DefaultBranchShape from \Casedev\Database\V1\Projects\ProjectNewResponse\DefaultBranch
 *
 * @phpstan-type ProjectNewResponseShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   defaultBranch: DefaultBranch|DefaultBranchShape,
 *   name: string,
 *   pgVersion: int,
 *   region: string,
 *   status: Status|value-of<Status>,
 *   description?: string|null,
 * }
 */
final class ProjectNewResponse implements BaseModel
{
    /** @use SdkModel<ProjectNewResponseShape> */
    use SdkModel;

    /**
     * Project ID.
     */
    #[Required]
    public string $id;

    /**
     * Project creation timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Default 'main' branch details.
     */
    #[Required]
    public DefaultBranch $defaultBranch;

    /**
     * Project name.
     */
    #[Required]
    public string $name;

    /**
     * PostgreSQL major version.
     */
    #[Required]
    public int $pgVersion;

    /**
     * AWS region.
     */
    #[Required]
    public string $region;

    /**
     * Project status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Project description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new ProjectNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectNewResponse::with(
     *   id: ...,
     *   createdAt: ...,
     *   defaultBranch: ...,
     *   name: ...,
     *   pgVersion: ...,
     *   region: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectNewResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDefaultBranch(...)
     *   ->withName(...)
     *   ->withPgVersion(...)
     *   ->withRegion(...)
     *   ->withStatus(...)
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
     * @param DefaultBranch|DefaultBranchShape $defaultBranch
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        DefaultBranch|array $defaultBranch,
        string $name,
        int $pgVersion,
        string $region,
        Status|string $status,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['defaultBranch'] = $defaultBranch;
        $self['name'] = $name;
        $self['pgVersion'] = $pgVersion;
        $self['region'] = $region;
        $self['status'] = $status;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Project ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Project creation timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Default 'main' branch details.
     *
     * @param DefaultBranch|DefaultBranchShape $defaultBranch
     */
    public function withDefaultBranch(DefaultBranch|array $defaultBranch): self
    {
        $self = clone $this;
        $self['defaultBranch'] = $defaultBranch;

        return $self;
    }

    /**
     * Project name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * PostgreSQL major version.
     */
    public function withPgVersion(int $pgVersion): self
    {
        $self = clone $this;
        $self['pgVersion'] = $pgVersion;

        return $self;
    }

    /**
     * AWS region.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * Project status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Project description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
