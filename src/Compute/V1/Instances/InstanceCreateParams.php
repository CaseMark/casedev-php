<?php

declare(strict_types=1);

namespace Router\Compute\V1\Instances;

use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Launches a new GPU compute instance with automatic SSH key generation. Supports mounting Case.dev Vaults as filesystems and configurable auto-shutdown. Instance boots in ~2-5 minutes. Perfect for batch OCR processing, AI model training, and intensive document analysis workloads.
 *
 * @see Router\Services\Compute\V1\InstancesService::create()
 *
 * @phpstan-type InstanceCreateParamsShape = array{
 *   instanceType: string,
 *   name: string,
 *   region: string,
 *   autoShutdownMinutes?: int|null,
 *   vaultIDs?: list<string>|null,
 * }
 */
final class InstanceCreateParams implements BaseModel
{
    /** @use SdkModel<InstanceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GPU type (e.g., 'gpu_1x_h100_sxm5').
     */
    #[Required]
    public string $instanceType;

    /**
     * Instance name.
     */
    #[Required]
    public string $name;

    /**
     * Region (e.g., 'us-west-1').
     */
    #[Required]
    public string $region;

    /**
     * Auto-shutdown timer (null = never).
     */
    #[Optional(nullable: true)]
    public ?int $autoShutdownMinutes;

    /**
     * Vault IDs to mount.
     *
     * @var list<string>|null $vaultIDs
     */
    #[Optional('vaultIds', list: 'string')]
    public ?array $vaultIDs;

    /**
     * `new InstanceCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InstanceCreateParams::with(instanceType: ..., name: ..., region: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InstanceCreateParams)
     *   ->withInstanceType(...)
     *   ->withName(...)
     *   ->withRegion(...)
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
     * @param list<string>|null $vaultIDs
     */
    public static function with(
        string $instanceType,
        string $name,
        string $region,
        ?int $autoShutdownMinutes = null,
        ?array $vaultIDs = null,
    ): self {
        $self = new self;

        $self['instanceType'] = $instanceType;
        $self['name'] = $name;
        $self['region'] = $region;

        null !== $autoShutdownMinutes && $self['autoShutdownMinutes'] = $autoShutdownMinutes;
        null !== $vaultIDs && $self['vaultIDs'] = $vaultIDs;

        return $self;
    }

    /**
     * GPU type (e.g., 'gpu_1x_h100_sxm5').
     */
    public function withInstanceType(string $instanceType): self
    {
        $self = clone $this;
        $self['instanceType'] = $instanceType;

        return $self;
    }

    /**
     * Instance name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Region (e.g., 'us-west-1').
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * Auto-shutdown timer (null = never).
     */
    public function withAutoShutdownMinutes(?int $autoShutdownMinutes): self
    {
        $self = clone $this;
        $self['autoShutdownMinutes'] = $autoShutdownMinutes;

        return $self;
    }

    /**
     * Vault IDs to mount.
     *
     * @param list<string> $vaultIDs
     */
    public function withVaultIDs(array $vaultIDs): self
    {
        $self = clone $this;
        $self['vaultIDs'] = $vaultIDs;

        return $self;
    }
}
