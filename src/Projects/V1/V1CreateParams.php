<?php

declare(strict_types=1);

namespace Casedev\Projects\V1;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Attributes\Required;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Concerns\SdkParams;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Projects\V1\V1CreateParams\SourceType;

/**
 * Create a new project for deployments.
 *
 * @see Casedev\Services\Projects\V1Service::create()
 *
 * @phpstan-type V1CreateParamsShape = array{
 *   name: string,
 *   sourceType: SourceType|value-of<SourceType>,
 *   buildCommand?: string|null,
 *   defaultMemory?: string|null,
 *   defaultVcpu?: string|null,
 *   description?: string|null,
 *   framework?: string|null,
 *   githubBranch?: string|null,
 *   githubRepo?: string|null,
 *   installCommand?: string|null,
 *   rootDirectory?: string|null,
 *   s3SourceBucket?: string|null,
 *   s3SourcePrefix?: string|null,
 *   startCommand?: string|null,
 *   thurgoodSessionID?: string|null,
 * }
 */
final class V1CreateParams implements BaseModel
{
    /** @use SdkModel<V1CreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Project name.
     */
    #[Required]
    public string $name;

    /** @var value-of<SourceType> $sourceType */
    #[Required(enum: SourceType::class)]
    public string $sourceType;

    #[Optional]
    public ?string $buildCommand;

    #[Optional]
    public ?string $defaultMemory;

    #[Optional]
    public ?string $defaultVcpu;

    /**
     * Project description.
     */
    #[Optional]
    public ?string $description;

    #[Optional]
    public ?string $framework;

    #[Optional]
    public ?string $githubBranch;

    /**
     * GitHub repo (owner/repo).
     */
    #[Optional]
    public ?string $githubRepo;

    #[Optional]
    public ?string $installCommand;

    #[Optional]
    public ?string $rootDirectory;

    #[Optional]
    public ?string $s3SourceBucket;

    #[Optional]
    public ?string $s3SourcePrefix;

    #[Optional]
    public ?string $startCommand;

    #[Optional('thurgoodSessionId')]
    public ?string $thurgoodSessionID;

    /**
     * `new V1CreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * V1CreateParams::with(name: ..., sourceType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new V1CreateParams)->withName(...)->withSourceType(...)
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
     * @param SourceType|value-of<SourceType> $sourceType
     */
    public static function with(
        string $name,
        SourceType|string $sourceType,
        ?string $buildCommand = null,
        ?string $defaultMemory = null,
        ?string $defaultVcpu = null,
        ?string $description = null,
        ?string $framework = null,
        ?string $githubBranch = null,
        ?string $githubRepo = null,
        ?string $installCommand = null,
        ?string $rootDirectory = null,
        ?string $s3SourceBucket = null,
        ?string $s3SourcePrefix = null,
        ?string $startCommand = null,
        ?string $thurgoodSessionID = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['sourceType'] = $sourceType;

        null !== $buildCommand && $self['buildCommand'] = $buildCommand;
        null !== $defaultMemory && $self['defaultMemory'] = $defaultMemory;
        null !== $defaultVcpu && $self['defaultVcpu'] = $defaultVcpu;
        null !== $description && $self['description'] = $description;
        null !== $framework && $self['framework'] = $framework;
        null !== $githubBranch && $self['githubBranch'] = $githubBranch;
        null !== $githubRepo && $self['githubRepo'] = $githubRepo;
        null !== $installCommand && $self['installCommand'] = $installCommand;
        null !== $rootDirectory && $self['rootDirectory'] = $rootDirectory;
        null !== $s3SourceBucket && $self['s3SourceBucket'] = $s3SourceBucket;
        null !== $s3SourcePrefix && $self['s3SourcePrefix'] = $s3SourcePrefix;
        null !== $startCommand && $self['startCommand'] = $startCommand;
        null !== $thurgoodSessionID && $self['thurgoodSessionID'] = $thurgoodSessionID;

        return $self;
    }

    /**
     * Project name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param SourceType|value-of<SourceType> $sourceType
     */
    public function withSourceType(SourceType|string $sourceType): self
    {
        $self = clone $this;
        $self['sourceType'] = $sourceType;

        return $self;
    }

    public function withBuildCommand(string $buildCommand): self
    {
        $self = clone $this;
        $self['buildCommand'] = $buildCommand;

        return $self;
    }

    public function withDefaultMemory(string $defaultMemory): self
    {
        $self = clone $this;
        $self['defaultMemory'] = $defaultMemory;

        return $self;
    }

    public function withDefaultVcpu(string $defaultVcpu): self
    {
        $self = clone $this;
        $self['defaultVcpu'] = $defaultVcpu;

        return $self;
    }

    /**
     * Project description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    public function withFramework(string $framework): self
    {
        $self = clone $this;
        $self['framework'] = $framework;

        return $self;
    }

    public function withGitHubBranch(string $githubBranch): self
    {
        $self = clone $this;
        $self['githubBranch'] = $githubBranch;

        return $self;
    }

    /**
     * GitHub repo (owner/repo).
     */
    public function withGitHubRepo(string $githubRepo): self
    {
        $self = clone $this;
        $self['githubRepo'] = $githubRepo;

        return $self;
    }

    public function withInstallCommand(string $installCommand): self
    {
        $self = clone $this;
        $self['installCommand'] = $installCommand;

        return $self;
    }

    public function withRootDirectory(string $rootDirectory): self
    {
        $self = clone $this;
        $self['rootDirectory'] = $rootDirectory;

        return $self;
    }

    public function withS3SourceBucket(string $s3SourceBucket): self
    {
        $self = clone $this;
        $self['s3SourceBucket'] = $s3SourceBucket;

        return $self;
    }

    public function withS3SourcePrefix(string $s3SourcePrefix): self
    {
        $self = clone $this;
        $self['s3SourcePrefix'] = $s3SourcePrefix;

        return $self;
    }

    public function withStartCommand(string $startCommand): self
    {
        $self = clone $this;
        $self['startCommand'] = $startCommand;

        return $self;
    }

    public function withThurgoodSessionID(string $thurgoodSessionID): self
    {
        $self = clone $this;
        $self['thurgoodSessionID'] = $thurgoodSessionID;

        return $self;
    }
}
