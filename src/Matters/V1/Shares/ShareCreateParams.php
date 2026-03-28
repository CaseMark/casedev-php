<?php

declare(strict_types=1);

namespace CaseDev\Matters\V1\Shares;

use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;
use CaseDev\Matters\V1\Shares\ShareCreateParams\Permission;

/**
 * Grant another organization scoped access to this matter and its primary vault.
 *
 * @see CaseDev\Services\Matters\V1\SharesService::create()
 *
 * @phpstan-type ShareCreateParamsShape = array{
 *   targetOrgID: string,
 *   expiresAt?: \DateTimeInterface|null,
 *   permission?: null|Permission|value-of<Permission>,
 * }
 */
final class ShareCreateParams implements BaseModel
{
    /** @use SdkModel<ShareCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required('target_org_id')]
    public string $targetOrgID;

    #[Optional('expires_at', nullable: true)]
    public ?\DateTimeInterface $expiresAt;

    /** @var value-of<Permission>|null $permission */
    #[Optional(enum: Permission::class)]
    public ?string $permission;

    /**
     * `new ShareCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ShareCreateParams::with(targetOrgID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ShareCreateParams)->withTargetOrgID(...)
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
     * @param Permission|value-of<Permission>|null $permission
     */
    public static function with(
        string $targetOrgID,
        ?\DateTimeInterface $expiresAt = null,
        Permission|string|null $permission = null,
    ): self {
        $self = new self;

        $self['targetOrgID'] = $targetOrgID;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $permission && $self['permission'] = $permission;

        return $self;
    }

    public function withTargetOrgID(string $targetOrgID): self
    {
        $self = clone $this;
        $self['targetOrgID'] = $targetOrgID;

        return $self;
    }

    public function withExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * @param Permission|value-of<Permission> $permission
     */
    public function withPermission(Permission|string $permission): self
    {
        $self = clone $this;
        $self['permission'] = $permission;

        return $self;
    }
}
