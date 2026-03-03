<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Search the Legal Skills Store using hybrid search (text + tag + semantic). Returns ranked results with relevance scores.
 *
 * @see CaseDev\Services\SkillsService::resolve()
 *
 * @phpstan-type SkillResolveParamsShape = array{q: string, limit?: int|null}
 */
final class SkillResolveParams implements BaseModel
{
    /** @use SdkModel<SkillResolveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Search query string.
     */
    #[Required]
    public string $q;

    /**
     * Maximum number of results to return (1-20).
     */
    #[Optional]
    public ?int $limit;

    /**
     * `new SkillResolveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SkillResolveParams::with(q: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SkillResolveParams)->withQ(...)
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
    public static function with(string $q, ?int $limit = null): self
    {
        $self = new self;

        $self['q'] = $q;

        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Search query string.
     */
    public function withQ(string $q): self
    {
        $self = clone $this;
        $self['q'] = $q;

        return $self;
    }

    /**
     * Maximum number of results to return (1-20).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
