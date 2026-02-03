<?php

declare(strict_types=1);

namespace Casedev\Database\V1\Projects;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Database\V1\Projects\ProjectGetResponse\Branch;
use Casedev\Database\V1\Projects\ProjectGetResponse\Database;
use Casedev\Database\V1\Projects\ProjectGetResponse\LinkedDeployment;
use Casedev\Database\V1\Projects\ProjectGetResponse\Status;

/**
 * @phpstan-import-type BranchShape from \Casedev\Database\V1\Projects\ProjectGetResponse\Branch
 * @phpstan-import-type DatabaseShape from \Casedev\Database\V1\Projects\ProjectGetResponse\Database
 * @phpstan-import-type LinkedDeploymentShape from \Casedev\Database\V1\Projects\ProjectGetResponse\LinkedDeployment
 *
 * @phpstan-type ProjectGetResponseShape = array{
 *   id: string,
 *   branches: list<Branch|BranchShape>,
 *   computeTimeSeconds: float,
 *   connectionHost: string,
 *   createdAt: \DateTimeInterface,
 *   databases: list<Database|DatabaseShape>,
 *   linkedDeployments: list<LinkedDeployment|LinkedDeploymentShape>,
 *   name: string,
 *   pgVersion: int,
 *   region: string,
 *   status: Status|value-of<Status>,
 *   storageSizeBytes: float,
 *   updatedAt: \DateTimeInterface,
 *   description?: string|null,
 * }
 */
final class ProjectGetResponse implements BaseModel
{
    /** @use SdkModel<ProjectGetResponseShape> */
    use SdkModel;

    /**
     * Project ID.
     */
    #[Required]
    public string $id;

    /**
     * All branches in this project.
     *
     * @var list<Branch> $branches
     */
    #[Required(list: Branch::class)]
    public array $branches;

    /**
     * Total compute time consumed in seconds.
     */
    #[Required]
    public float $computeTimeSeconds;

    /**
     * Database connection hostname (masked for security).
     */
    #[Required]
    public string $connectionHost;

    /**
     * Project creation timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Databases in the default branch.
     *
     * @var list<Database> $databases
     */
    #[Required(list: Database::class)]
    public array $databases;

    /**
     * Linked deployments using this database.
     *
     * @var list<LinkedDeployment> $linkedDeployments
     */
    #[Required(list: LinkedDeployment::class)]
    public array $linkedDeployments;

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
     * Current storage usage in bytes.
     */
    #[Required]
    public float $storageSizeBytes;

    /**
     * Project last update timestamp.
     */
    #[Required]
    public \DateTimeInterface $updatedAt;

    /**
     * Project description.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new ProjectGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectGetResponse::with(
     *   id: ...,
     *   branches: ...,
     *   computeTimeSeconds: ...,
     *   connectionHost: ...,
     *   createdAt: ...,
     *   databases: ...,
     *   linkedDeployments: ...,
     *   name: ...,
     *   pgVersion: ...,
     *   region: ...,
     *   status: ...,
     *   storageSizeBytes: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectGetResponse)
     *   ->withID(...)
     *   ->withBranches(...)
     *   ->withComputeTimeSeconds(...)
     *   ->withConnectionHost(...)
     *   ->withCreatedAt(...)
     *   ->withDatabases(...)
     *   ->withLinkedDeployments(...)
     *   ->withName(...)
     *   ->withPgVersion(...)
     *   ->withRegion(...)
     *   ->withStatus(...)
     *   ->withStorageSizeBytes(...)
     *   ->withUpdatedAt(...)
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
     * @param list<Branch|BranchShape> $branches
     * @param list<Database|DatabaseShape> $databases
     * @param list<LinkedDeployment|LinkedDeploymentShape> $linkedDeployments
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        array $branches,
        float $computeTimeSeconds,
        string $connectionHost,
        \DateTimeInterface $createdAt,
        array $databases,
        array $linkedDeployments,
        string $name,
        int $pgVersion,
        string $region,
        Status|string $status,
        float $storageSizeBytes,
        \DateTimeInterface $updatedAt,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['branches'] = $branches;
        $self['computeTimeSeconds'] = $computeTimeSeconds;
        $self['connectionHost'] = $connectionHost;
        $self['createdAt'] = $createdAt;
        $self['databases'] = $databases;
        $self['linkedDeployments'] = $linkedDeployments;
        $self['name'] = $name;
        $self['pgVersion'] = $pgVersion;
        $self['region'] = $region;
        $self['status'] = $status;
        $self['storageSizeBytes'] = $storageSizeBytes;
        $self['updatedAt'] = $updatedAt;

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
     * All branches in this project.
     *
     * @param list<Branch|BranchShape> $branches
     */
    public function withBranches(array $branches): self
    {
        $self = clone $this;
        $self['branches'] = $branches;

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
     * Database connection hostname (masked for security).
     */
    public function withConnectionHost(string $connectionHost): self
    {
        $self = clone $this;
        $self['connectionHost'] = $connectionHost;

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
     * Databases in the default branch.
     *
     * @param list<Database|DatabaseShape> $databases
     */
    public function withDatabases(array $databases): self
    {
        $self = clone $this;
        $self['databases'] = $databases;

        return $self;
    }

    /**
     * Linked deployments using this database.
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
