<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects\ProjectListResponse\Project;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;

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

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?string $domain;

    #[Optional]
    public ?bool $isPrimary;

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

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withDomain(string $domain): self
    {
        $self = clone $this;
        $self['domain'] = $domain;

        return $self;
    }

    public function withIsPrimary(bool $isPrimary): self
    {
        $self = clone $this;
        $self['isPrimary'] = $isPrimary;

        return $self;
    }

    public function withIsVerified(bool $isVerified): self
    {
        $self = clone $this;
        $self['isVerified'] = $isVerified;

        return $self;
    }
}
