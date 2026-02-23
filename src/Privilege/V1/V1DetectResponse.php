<?php

declare(strict_types=1);

namespace Router\Privilege\V1;

use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Contracts\BaseModel;
use Router\Privilege\V1\V1DetectResponse\Category;
use Router\Privilege\V1\V1DetectResponse\Recommendation;

/**
 * @phpstan-import-type CategoryShape from \Router\Privilege\V1\V1DetectResponse\Category
 *
 * @phpstan-type V1DetectResponseShape = array{
 *   categories: list<Category|CategoryShape>,
 *   confidence: float,
 *   policyRationale: string,
 *   privileged: bool,
 *   recommendation: Recommendation|value-of<Recommendation>,
 * }
 */
final class V1DetectResponse implements BaseModel
{
    /** @use SdkModel<V1DetectResponseShape> */
    use SdkModel;

    /** @var list<Category> $categories */
    #[Required(list: Category::class)]
    public array $categories;

    /**
     * Overall confidence score (0-1).
     */
    #[Required]
    public float $confidence;

    /**
     * Policy-friendly explanation for privilege log.
     */
    #[Required('policy_rationale')]
    public string $policyRationale;

    /**
     * Whether any privilege was detected.
     */
    #[Required]
    public bool $privileged;

    /**
     * Recommended action for discovery.
     *
     * @var value-of<Recommendation> $recommendation
     */
    #[Required(enum: Recommendation::class)]
    public string $recommendation;

    /**
     * `new V1DetectResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1DetectResponse::with(
     *   categories: ...,
     *   confidence: ...,
     *   policyRationale: ...,
     *   privileged: ...,
     *   recommendation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1DetectResponse)
     *   ->withCategories(...)
     *   ->withConfidence(...)
     *   ->withPolicyRationale(...)
     *   ->withPrivileged(...)
     *   ->withRecommendation(...)
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
     * @param list<Category|CategoryShape> $categories
     * @param Recommendation|value-of<Recommendation> $recommendation
     */
    public static function with(
        array $categories,
        float $confidence,
        string $policyRationale,
        bool $privileged,
        Recommendation|string $recommendation,
    ): self {
        $self = new self;

        $self['categories'] = $categories;
        $self['confidence'] = $confidence;
        $self['policyRationale'] = $policyRationale;
        $self['privileged'] = $privileged;
        $self['recommendation'] = $recommendation;

        return $self;
    }

    /**
     * @param list<Category|CategoryShape> $categories
     */
    public function withCategories(array $categories): self
    {
        $self = clone $this;
        $self['categories'] = $categories;

        return $self;
    }

    /**
     * Overall confidence score (0-1).
     */
    public function withConfidence(float $confidence): self
    {
        $self = clone $this;
        $self['confidence'] = $confidence;

        return $self;
    }

    /**
     * Policy-friendly explanation for privilege log.
     */
    public function withPolicyRationale(string $policyRationale): self
    {
        $self = clone $this;
        $self['policyRationale'] = $policyRationale;

        return $self;
    }

    /**
     * Whether any privilege was detected.
     */
    public function withPrivileged(bool $privileged): self
    {
        $self = clone $this;
        $self['privileged'] = $privileged;

        return $self;
    }

    /**
     * Recommended action for discovery.
     *
     * @param Recommendation|value-of<Recommendation> $recommendation
     */
    public function withRecommendation(
        Recommendation|string $recommendation
    ): self {
        $self = clone $this;
        $self['recommendation'] = $recommendation;

        return $self;
    }
}
