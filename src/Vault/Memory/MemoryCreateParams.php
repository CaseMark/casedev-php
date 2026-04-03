<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Vault\Memory\MemoryCreateParams\Type;

/**
 * Append a new file-backed memory entry to a vault.
 *
 * @see CaseDev\Services\Vault\MemoryService::create()
 *
 * @phpstan-type MemoryCreateParamsShape = array{
 *   content: string,
 *   type: Type|value-of<Type>,
 *   source?: string|null,
 *   tags?: list<string>|null,
 * }
 */
final class MemoryCreateParams implements BaseModel
{
    /** @use SdkModel<MemoryCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $content;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional]
    public ?string $source;

    /** @var list<string>|null $tags */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new MemoryCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MemoryCreateParams::with(content: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MemoryCreateParams)->withContent(...)->withType(...)
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
     * @param list<string>|null $tags
     */
    public static function with(
        string $content,
        Type|string $type,
        ?string $source = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['type'] = $type;

        null !== $source && $self['source'] = $source;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

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

    public function withSource(string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
