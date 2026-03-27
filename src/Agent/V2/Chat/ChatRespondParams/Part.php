<?php

declare(strict_types=1);

namespace CaseDev\Agent\V2\Chat\ChatRespondParams;

use CaseDev\Agent\V2\Chat\ChatRespondParams\Part\Type;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;

/**
 * @phpstan-type PartShape = array{text: string, type: Type|value-of<Type>}
 */
final class Part implements BaseModel
{
    /** @use SdkModel<PartShape> */
    use SdkModel;

    /**
     * The message text content.
     */
    #[Required]
    public string $text;

    /**
     * Part type. Currently only "text" is supported.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Part()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Part::with(text: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Part)->withText(...)->withType(...)
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
     */
    public static function with(string $text, Type|string $type): self
    {
        $self = new self;

        $self['text'] = $text;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The message text content.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Part type. Currently only "text" is supported.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
