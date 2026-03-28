<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Parties;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\Parties\PartyListParams\Type;

/**
 * List reusable legal parties for the authenticated organization.
 *
 * @see CaseDev\Services\Matters\V1\PartiesService::list()
 *
 * @phpstan-type PartyListParamsShape = array{
 *   email?: string|null, query?: string|null, type?: null|Type|value-of<Type>
 * }
 */
final class PartyListParams implements BaseModel
{
    /** @use SdkModel<PartyListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?string $email;

    #[Optional]
    public ?string $query;

    /** @var value-of<Type>|null $type */
    #[Optional(enum: Type::class)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?string $email = null,
        ?string $query = null,
        Type|string|null $type = null
    ): self {
        $self = new self;

        null !== $email && $self['email'] = $email;
        null !== $query && $self['query'] = $query;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withQuery(string $query): self
    {
        $self = clone $this;
        $self['query'] = $query;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
