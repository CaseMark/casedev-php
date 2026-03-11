<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects\ProjectListResponse;

use CaseDev\Applications\V1\Projects\ProjectListResponse\Project\Domain;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DomainShape from \CaseDev\Applications\V1\Projects\ProjectListResponse\Project\Domain
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

    /**
     * Project identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * When the project record was created.
     */
    #[Optional]
    public ?string $createdAt;

    /**
     * Custom or generated domains assigned to the project.
     *
     * @var list<Domain>|null $domains
     */
    #[Optional(list: Domain::class)]
    public ?array $domains;

    /**
     * Detected or configured application framework.
     */
    #[Optional]
    public ?string $framework;

    /**
     * Default Git branch used for deployments.
     */
    #[Optional]
    public ?string $gitBranch;

    /**
     * Connected Git repository in owner/repo format.
     */
    #[Optional]
    public ?string $gitRepo;

    /**
     * Project display name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Current project deployment status.
     */
    #[Optional]
    public ?string $status;

    /**
     * When the project record was last updated.
     */
    #[Optional]
    public ?string $updatedAt;

    /**
     * Hosting provider project ID, when linked.
     */
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

    /**
     * Project identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the project record was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Custom or generated domains assigned to the project.
     *
     * @param list<Domain|DomainShape> $domains
     */
    public function withDomains(array $domains): self
    {
        $self = clone $this;
        $self['domains'] = $domains;

        return $self;
    }

    /**
     * Detected or configured application framework.
     */
    public function withFramework(string $framework): self
    {
        $self = clone $this;
        $self['framework'] = $framework;

        return $self;
    }

    /**
     * Default Git branch used for deployments.
     */
    public function withGitBranch(string $gitBranch): self
    {
        $self = clone $this;
        $self['gitBranch'] = $gitBranch;

        return $self;
    }

    /**
     * Connected Git repository in owner/repo format.
     */
    public function withGitRepo(string $gitRepo): self
    {
        $self = clone $this;
        $self['gitRepo'] = $gitRepo;

        return $self;
    }

    /**
     * Project display name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Current project deployment status.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * When the project record was last updated.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Hosting provider project ID, when linked.
     */
    public function withVercelProjectID(string $vercelProjectID): self
    {
        $self = clone $this;
        $self['vercelProjectID'] = $vercelProjectID;

        return $self;
    }
}
