<?php

declare(strict_types=1);

namespace CaseDev\Skills;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Skills\SkillResolveResponse\Result;

/**
 * @phpstan-import-type ResultShape from \CaseDev\Skills\SkillResolveResponse\Result
 *
 * @phpstan-type SkillResolveResponseShape = array{
 *   methodsUsed?: list<string>|null, results?: list<Result|ResultShape>|null
 * }
 */
final class SkillResolveResponse implements BaseModel
{
    /** @use SdkModel<SkillResolveResponseShape> */
    use SdkModel;

    /**
     * Search methods used (text, tag, semantic).
     *
     * @var list<string>|null $methodsUsed
     */
    #[Optional('methods_used', list: 'string')]
    public ?array $methodsUsed;

    /** @var list<Result>|null $results */
    #[Optional(list: Result::class)]
    public ?array $results;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $methodsUsed
     * @param list<Result|ResultShape>|null $results
     */
    public static function with(
        ?array $methodsUsed = null,
        ?array $results = null
    ): self {
        $self = new self;

        null !== $methodsUsed && $self['methodsUsed'] = $methodsUsed;
        null !== $results && $self['results'] = $results;

        return $self;
    }

    /**
     * Search methods used (text, tag, semantic).
     *
     * @param list<string> $methodsUsed
     */
    public function withMethodsUsed(array $methodsUsed): self
    {
        $self = clone $this;
        $self['methodsUsed'] = $methodsUsed;

        return $self;
    }

    /**
     * @param list<Result|ResultShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
