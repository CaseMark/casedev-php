<?php

declare(strict_types=1);

namespace Casedev\Payments\V1\Holds\HoldCreateParams;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Payments\V1\Holds\HoldCreateParams\ReleaseCondition\Type;

/**
 * @phpstan-type ReleaseConditionShape = array{
 *   approvers?: list<string>|null,
 *   date?: string|null,
 *   documentID?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class ReleaseCondition implements BaseModel
{
    /** @use SdkModel<ReleaseConditionShape> */
    use SdkModel;

    /** @var list<string>|null $approvers */
    #[Optional(list: 'string')]
    public ?array $approvers;

    #[Optional]
    public ?string $date;

    #[Optional('document_id')]
    public ?string $documentID;

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
     * @param list<string>|null $approvers
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?array $approvers = null,
        ?string $date = null,
        ?string $documentID = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $approvers && $self['approvers'] = $approvers;
        null !== $date && $self['date'] = $date;
        null !== $documentID && $self['documentID'] = $documentID;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * @param list<string> $approvers
     */
    public function withApprovers(array $approvers): self
    {
        $self = clone $this;
        $self['approvers'] = $approvers;

        return $self;
    }

    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    public function withDocumentID(string $documentID): self
    {
        $self = clone $this;
        $self['documentID'] = $documentID;

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
