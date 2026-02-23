<?php

declare(strict_types=1);

namespace Router\Superdoc\V1\V1AnnotateParams;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Superdoc\V1\V1AnnotateParams\Field\Options;
use Router\Superdoc\V1\V1AnnotateParams\Field\Type;

/**
 * @phpstan-import-type ValueVariants from \Router\Superdoc\V1\V1AnnotateParams\Field\Value
 * @phpstan-import-type ValueShape from \Router\Superdoc\V1\V1AnnotateParams\Field\Value
 * @phpstan-import-type OptionsShape from \Router\Superdoc\V1\V1AnnotateParams\Field\Options
 *
 * @phpstan-type FieldShape = array{
 *   type: Type|value-of<Type>,
 *   value: ValueShape,
 *   id?: string|null,
 *   group?: string|null,
 *   options?: null|Options|OptionsShape,
 * }
 */
final class Field implements BaseModel
{
    /** @use SdkModel<FieldShape> */
    use SdkModel;

    /**
     * Field data type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Value to populate.
     *
     * @var ValueVariants $value
     */
    #[Required]
    public string|float $value;

    /**
     * Target field ID (for single field).
     */
    #[Optional]
    public ?string $id;

    /**
     * Target field group (for multiple fields with same tag).
     */
    #[Optional]
    public ?string $group;

    /**
     * Optional configuration (e.g., image dimensions).
     */
    #[Optional]
    public ?Options $options;

    /**
     * `new Field()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Field::with(type: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Field)->withType(...)->withValue(...)
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
     * @param Type|value-of<Type> $type
     * @param ValueShape $value
     * @param Options|OptionsShape|null $options
     */
    public static function with(
        Type|string $type,
        string|float $value,
        ?string $id = null,
        ?string $group = null,
        Options|array|null $options = null,
    ): self {
        $self = new self;

        $self['type'] = $type;
        $self['value'] = $value;

        null !== $id && $self['id'] = $id;
        null !== $group && $self['group'] = $group;
        null !== $options && $self['options'] = $options;

        return $self;
    }

    /**
     * Field data type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Value to populate.
     *
     * @param ValueShape $value
     */
    public function withValue(string|float $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Target field ID (for single field).
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Target field group (for multiple fields with same tag).
     */
    public function withGroup(string $group): self
    {
        $self = clone $this;
        $self['group'] = $group;

        return $self;
    }

    /**
     * Optional configuration (e.g., image dimensions).
     *
     * @param Options|OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }
}
