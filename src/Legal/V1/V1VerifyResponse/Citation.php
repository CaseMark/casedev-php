<?php

declare(strict_types=1);

namespace Router\Legal\V1\V1VerifyResponse;

use Router\Core\Attributes\Optional;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Legal\V1\V1VerifyResponse\Citation\Candidate;
use Router\Legal\V1\V1VerifyResponse\Citation\Case_;
use Router\Legal\V1\V1VerifyResponse\Citation\Span;
use Router\Legal\V1\V1VerifyResponse\Citation\Status;
use Router\Legal\V1\V1VerifyResponse\Citation\VerificationSource;

/**
 * @phpstan-import-type CandidateShape from \Router\Legal\V1\V1VerifyResponse\Citation\Candidate
 * @phpstan-import-type CaseShape from \Router\Legal\V1\V1VerifyResponse\Citation\Case_
 * @phpstan-import-type SpanShape from \Router\Legal\V1\V1VerifyResponse\Citation\Span
 *
 * @phpstan-type CitationShape = array{
 *   candidates?: list<Candidate|CandidateShape>|null,
 *   case?: null|Case_|CaseShape,
 *   confidence?: float|null,
 *   normalized?: string|null,
 *   original?: string|null,
 *   span?: null|Span|SpanShape,
 *   status?: null|Status|value-of<Status>,
 *   verificationSource?: null|VerificationSource|value-of<VerificationSource>,
 * }
 */
final class Citation implements BaseModel
{
    /** @use SdkModel<CitationShape> */
    use SdkModel;

    /**
     * Multiple candidates (when multiple_matches or heuristic verification).
     *
     * @var list<Candidate>|null $candidates
     */
    #[Optional(list: Candidate::class)]
    public ?array $candidates;

    /**
     * Case metadata (when verified).
     */
    #[Optional]
    public ?Case_ $case;

    /**
     * Confidence score (1.0 for CourtListener, heuristic score for fallback).
     */
    #[Optional]
    public ?float $confidence;

    /**
     * Normalized citation string.
     */
    #[Optional]
    public ?string $normalized;

    /**
     * Original citation as found in text.
     */
    #[Optional]
    public ?string $original;

    #[Optional]
    public ?Span $span;

    /** @var value-of<Status>|null $status */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Source of verification result (heuristic for fallback matches).
     *
     * @var value-of<VerificationSource>|null $verificationSource
     */
    #[Optional(enum: VerificationSource::class)]
    public ?string $verificationSource;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Candidate|CandidateShape>|null $candidates
     * @param Case_|CaseShape|null $case
     * @param Span|SpanShape|null $span
     * @param Status|value-of<Status>|null $status
     * @param VerificationSource|value-of<VerificationSource>|null $verificationSource
     */
    public static function with(
        ?array $candidates = null,
        Case_|array|null $case = null,
        ?float $confidence = null,
        ?string $normalized = null,
        ?string $original = null,
        Span|array|null $span = null,
        Status|string|null $status = null,
        VerificationSource|string|null $verificationSource = null,
    ): self {
        $self = new self;

        null !== $candidates && $self['candidates'] = $candidates;
        null !== $case && $self['case'] = $case;
        null !== $confidence && $self['confidence'] = $confidence;
        null !== $normalized && $self['normalized'] = $normalized;
        null !== $original && $self['original'] = $original;
        null !== $span && $self['span'] = $span;
        null !== $status && $self['status'] = $status;
        null !== $verificationSource && $self['verificationSource'] = $verificationSource;

        return $self;
    }

    /**
     * Multiple candidates (when multiple_matches or heuristic verification).
     *
     * @param list<Candidate|CandidateShape> $candidates
     */
    public function withCandidates(array $candidates): self
    {
        $self = clone $this;
        $self['candidates'] = $candidates;

        return $self;
    }

    /**
     * Case metadata (when verified).
     *
     * @param Case_|CaseShape $case
     */
    public function withCase(Case_|array $case): self
    {
        $self = clone $this;
        $self['case'] = $case;

        return $self;
    }

    /**
     * Confidence score (1.0 for CourtListener, heuristic score for fallback).
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Normalized citation string.
     */
    public function withNormalized(string $normalized): self
    {
        $self = clone $this;
        $self['normalized'] = $normalized;

        return $self;
    }

    /**
     * Original citation as found in text.
     */
    public function withOriginal(string $original): self
    {
        $self = clone $this;
        $self['original'] = $original;

        return $self;
    }

    /**
     * @param Span|SpanShape $span
     */
    public function withSpan(Span|array $span): self
    {
        $self = clone $this;
        $self['span'] = $span;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Source of verification result (heuristic for fallback matches).
     *
     * @param VerificationSource|value-of<VerificationSource> $verificationSource
     */
    public function withVerificationSource(
        VerificationSource|string $verificationSource
    ): self {
        $self = clone $this;
        $self['verificationSource'] = $verificationSource;

        return $self;
    }
}
