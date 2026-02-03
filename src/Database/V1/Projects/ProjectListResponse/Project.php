<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects\ProjectListResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Database\V1\Projects\ProjectListResponse\Project\LinkedDeployment;
use Casedev\Database\V1\Projects\ProjectListResponse\Project\Status;

/**
 * @phpstan-import-type LinkedDeploymentShape from \Casedev\Database\V1\Projects\ProjectListResponse\Project\LinkedDeployment
 *
 * @phpstan-type ProjectShape = array{
 *   id?: string|null,
 *   computeTimeSeconds?: float|null,
 *   createdAt?: \DateTimeInterface|null,
 *   description?: string|null,
 *   linkedDeployments?: list<LinkedDeployment|LinkedDeploymentShape>|null,
 *   name?: string|null,
 *   pgVersion?: int|null,
 *   region?: string|null,
 *   status?: null|Status|value-of<Status>,
 *   storageSizeBytes?: float|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class Project implements BaseModel
{
    /** @use SdkModel<ProjectShape> */
    use SdkModel;

    /**
     * Project ID.
     */
    #[Optional]
    public ?string $id;

    /**
     * Total compute time consumed in seconds.
     */
    #[Optional]
    public ?float $computeTimeSeconds;

    /**
     * Project creation timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * Project description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Linked application deployments using this database.
     *
     * @var list<LinkedDeployment>|null $linkedDeployments
     */
    #[Optional(list: LinkedDeployment::class)]
    public ?array $linkedDeployments;

    /**
     * Project name.
     */
    #[Optional]
    public ?string $name;

    /**
     * PostgreSQL major version.
     */
    #[Optional]
    public ?int $pgVersion;

    /**
     * AWS region where database is deployed.
     */
    #[Optional]
    public ?string $region;

    /**
     * Current project status.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Current storage usage in bytes.
     */
    #[Optional]
    public ?float $storageSizeBytes;

    /**
     * Project last update timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<LinkedDeployment|LinkedDeploymentShape>|null $linkedDeployments
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        ?float $computeTimeSeconds = null,
        ?\DateTimeInterface $createdAt = null,
        ?string $description = null,
        ?array $linkedDeployments = null,
        ?string $name = null,
        ?int $pgVersion = null,
        ?string $region = null,
        Status|string|null $status = null,
        ?float $storageSizeBytes = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $computeTimeSeconds && $self['computeTimeSeconds'] = $computeTimeSeconds;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $description && $self['description'] = $description;
        null !== $linkedDeployments && $self['linkedDeployments'] = $linkedDeployments;
        null !== $name && $self['name'] = $name;
        null !== $pgVersion && $self['pgVersion'] = $pgVersion;
        null !== $region && $self['region'] = $region;
        null !== $status && $self['status'] = $status;
        null !== $storageSizeBytes && $self['storageSizeBytes'] = $storageSizeBytes;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

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
     * Total compute time consumed in seconds.
     */
    public function withComputeTimeSeconds(float $computeTimeSeconds): self
    {
        $self = clone $this;
        $self['computeTimeSeconds'] = $computeTimeSeconds;

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
     * Project description.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Linked application deployments using this database.
     *
     * @param list<LinkedDeployment|LinkedDeploymentShape> $linkedDeployments
     */
    public function withLinkedDeployments(array $linkedDeployments): self
    {
        $self = clone $this;
        $self['linkedDeployments'] = $linkedDeployments;

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
     * AWS region where database is deployed.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * Current project status.
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
     * Current storage usage in bytes.
     */
    public function withStorageSizeBytes(float $storageSizeBytes): self
    {
        $self = clone $this;
        $self['storageSizeBytes'] = $storageSizeBytes;

        return $self;
    }

    /**
     * Project last update timestamp.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
