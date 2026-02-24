<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Add a custom domain to a project.
 *
 * @see CaseDev\Services\Applications\V1\ProjectsService::createDomain()
 *
 * @phpstan-type ProjectCreateDomainParamsShape = array{
 *   domain: string, gitBranch?: string|null
 * }
 */
final class ProjectCreateDomainParams implements BaseModel
{
    /** @use SdkModel<ProjectCreateDomainParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Domain name to add.
     */
    #[Required]
    public string $domain;

    /**
     * Git branch to associate with this domain.
     */
    #[Optional]
    public ?string $gitBranch;

    /**
     * `new ProjectCreateDomainParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectCreateDomainParams::with(domain: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectCreateDomainParams)->withDomain(...)
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
     */
    public static function with(string $domain, ?string $gitBranch = null): self
    {
        $self = new self;

        $self['domain'] = $domain;

        null !== $gitBranch && $self['gitBranch'] = $gitBranch;

        return $self;
    }

    /**
     * Domain name to add.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Git branch to associate with this domain.
     */
    public function withGitBranch(string $gitBranch): self
    {
        $self = clone $this;
        $self['gitBranch'] = $gitBranch;

        return $self;
    }
}
