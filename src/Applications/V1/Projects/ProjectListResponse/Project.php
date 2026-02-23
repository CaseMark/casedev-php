<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects\ProjectListResponse;

use Router\Applications\V1\Projects\ProjectListResponse\Project\Domain;
use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DomainShape from \Router\Applications\V1\Projects\ProjectListResponse\Project\Domain
 *
 * @phpstan-type ProjectShape = array{
 *   id?: string|null,
 *   createdAt?: string|null,
 *   domains?: list<Domain|DomainShape>|null,
 *   framework?: string|null,
 *   gitBranch?: string|null,
 *   gitRepo?: string|null,
 *   name?: string|null,
 *   status?: string|null,
 *   updatedAt?: string|null,
 *   vercelProjectID?: string|null,
 * }
 */
final class Project implements BaseModel
{
    /** @use SdkModel<ProjectShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $createdAt;

    /** @var list<Domain>|null $domains */
    #[Optional(list: Domain::class)]
    public ?array $domains;

    #[Optional]
    public ?string $framework;

    #[Optional]
    public ?string $gitBranch;

    #[Optional]
    public ?string $gitRepo;

    #[Optional]
    public ?string $name;

    #[Optional]
    public ?string $status;

    #[Optional]
    public ?string $updatedAt;

    #[Optional('vercelProjectId')]
    public ?string $vercelProjectID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Domain|DomainShape>|null $domains
     */
    public static function with(
        ?string $id = null,
        ?string $createdAt = null,
        ?array $domains = null,
        ?string $framework = null,
        ?string $gitBranch = null,
        ?string $gitRepo = null,
        ?string $name = null,
        ?string $status = null,
        ?string $updatedAt = null,
        ?string $vercelProjectID = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $domains && $self['domains'] = $domains;
        null !== $framework && $self['framework'] = $framework;
        null !== $gitBranch && $self['gitBranch'] = $gitBranch;
        null !== $gitRepo && $self['gitRepo'] = $gitRepo;
        null !== $name && $self['name'] = $name;
        null !== $status && $self['status'] = $status;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $vercelProjectID && $self['vercelProjectID'] = $vercelProjectID;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param list<Domain|DomainShape> $domains
     */
    public function withDomains(array $domains): self
    {
        $self = clone $this;
        $self['domains'] = $domains;

        return $self;
    }

    public function withFramework(string $framework): self
    {
        $self = clone $this;
        $self['framework'] = $framework;

        return $self;
    }

    public function withGitBranch(string $gitBranch): self
    {
        $self = clone $this;
        $self['gitBranch'] = $gitBranch;

        return $self;
    }

    public function withGitRepo(string $gitRepo): self
    {
        $self = clone $this;
        $self['gitRepo'] = $gitRepo;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withVercelProjectID(string $vercelProjectID): self
    {
        $self = clone $this;
        $self['vercelProjectID'] = $vercelProjectID;

        return $self;
    }
}
