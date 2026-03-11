<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects\ProjectListResponse\Project;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type DomainShape = array{
 *   id?: string|null,
 *   domain?: string|null,
 *   isPrimary?: bool|null,
 *   isVerified?: bool|null,
 * }
 */
final class Domain implements BaseModel
{
    /** @use SdkModel<DomainShape> */
    use SdkModel;

    /**
     * Domain record identifier.
     */
    #[Optional]
    public ?string $id;

    /**
     * Hostname assigned to the project.
     */
    #[Optional]
    public ?string $domain;

    /**
     * Whether this is the primary project domain.
     */
    #[Optional]
    public ?bool $isPrimary;

    /**
     * Whether the domain has been verified by the hosting provider.
     */
    #[Optional]
    public ?bool $isVerified;

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
        ?string $id = null,
        ?string $domain = null,
        ?bool $isPrimary = null,
        ?bool $isVerified = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $domain && $self['domain'] = $domain;
        null !== $isPrimary && $self['isPrimary'] = $isPrimary;
        null !== $isVerified && $self['isVerified'] = $isVerified;

        return $self;
    }

    /**
     * Domain record identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Hostname assigned to the project.
     */
    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    /**
     * Whether this is the primary project domain.
     */
    public function withIsPrimary(bool $isPrimary): self
    {
        $self = clone $this;
        $self['isPrimary'] = $isPrimary;

        return $self;
    }

    /**
     * Whether the domain has been verified by the hosting provider.
     */
    public function withIsVerified(bool $isVerified): self
    {
        $self = clone $this;
        $self['isVerified'] = $isVerified;

        return $self;
    }
}
