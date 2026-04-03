<?php

declare(strict_types=1);

namespace CaseDev\Vault\Memory;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Rewrite a file-backed vault memory entry with updated content, source, or tags.
 *
 * @see CaseDev\Services\Vault\MemoryService::update()
 *
 * @phpstan-type MemoryUpdateParamsShape = array{
 *   id: string,
 *   content?: string|null,
 *   source?: string|null,
 *   tags?: list<string>|null,
 * }
 */
final class MemoryUpdateParams implements BaseModel
{
    /** @use SdkModel<MemoryUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    #[Optional]
    public ?string $content;

    #[Optional(nullable: true)]
    public ?string $source;

    /** @var list<string>|null $tags */
    #[Optional(list: 'string')]
    public ?array $tags;

    /**
     * `new MemoryUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MemoryUpdateParams::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MemoryUpdateParams)->withID(...)
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
     * @param list<string>|null $tags
     */
    public static function with(
        string $id,
        ?string $content = null,
        ?string $source = null,
        ?array $tags = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $content && $self['content'] = $content;
        null !== $source && $self['source'] = $source;
        null !== $tags && $self['tags'] = $tags;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    public function withSource(?string $source): self
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
