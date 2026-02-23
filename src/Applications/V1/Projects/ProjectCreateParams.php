<?php

declare(strict_types=1);

namespace Router\Applications\V1\Projects;

use Router\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable;
use Router\Core\Attributes\Optional;
use Router\Core\Attributes\Required;
use Router\Core\Concerns\SdkModel;
use Router\Core\Concerns\SdkParams;
use Router\Core\Contracts\BaseModel;

/**
 * Create a new web application project.
 *
 * @see Router\Services\Applications\V1\ProjectsService::create()
 *
 * @phpstan-import-type EnvironmentVariableShape from \Router\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable
 *
 * @phpstan-type ProjectCreateParamsShape = array{
 *   gitRepo: string,
 *   name: string,
 *   buildCommand?: string|null,
 *   environmentVariables?: list<EnvironmentVariable|EnvironmentVariableShape>|null,
 *   framework?: string|null,
 *   gitBranch?: string|null,
 *   installCommand?: string|null,
 *   outputDirectory?: string|null,
 *   rootDirectory?: string|null,
 * }
 */
final class ProjectCreateParams implements BaseModel
{
    /** @use SdkModel<ProjectCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * GitHub repository URL or "owner/repo".
     */
    #[Required]
    public string $gitRepo;

    /**
     * Project name.
     */
    #[Required]
    public string $name;

    /**
     * Custom build command.
     */
    #[Optional]
    public ?string $buildCommand;

    /**
     * Environment variables to set on the project.
     *
     * @var list<EnvironmentVariable>|null $environmentVariables
     */
    #[Optional(list: EnvironmentVariable::class)]
    public ?array $environmentVariables;

    /**
     * Framework (e.g., "nextjs", "remix", "astro").
     */
    #[Optional]
    public ?string $framework;

    /**
     * Git branch to deploy.
     */
    #[Optional]
    public ?string $gitBranch;

    /**
     * Custom install command.
     */
    #[Optional]
    public ?string $installCommand;

    /**
     * Build output directory.
     */
    #[Optional]
    public ?string $outputDirectory;

    /**
     * Root directory of the project.
     */
    #[Optional]
    public ?string $rootDirectory;

    /**
     * `new ProjectCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProjectCreateParams::with(gitRepo: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProjectCreateParams)->withGitRepo(...)->withName(...)
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
     * @param list<EnvironmentVariable|EnvironmentVariableShape>|null $environmentVariables
     */
    public static function with(
        string $gitRepo,
        string $name,
        ?string $buildCommand = null,
        ?array $environmentVariables = null,
        ?string $framework = null,
        ?string $gitBranch = null,
        ?string $installCommand = null,
        ?string $outputDirectory = null,
        ?string $rootDirectory = null,
    ): self {
        $self = new self;

        $self['gitRepo'] = $gitRepo;
        $self['name'] = $name;

        null !== $buildCommand && $self['buildCommand'] = $buildCommand;
        null !== $environmentVariables && $self['environmentVariables'] = $environmentVariables;
        null !== $framework && $self['framework'] = $framework;
        null !== $gitBranch && $self['gitBranch'] = $gitBranch;
        null !== $installCommand && $self['installCommand'] = $installCommand;
        null !== $outputDirectory && $self['outputDirectory'] = $outputDirectory;
        null !== $rootDirectory && $self['rootDirectory'] = $rootDirectory;

        return $self;
    }

    /**
     * GitHub repository URL or "owner/repo".
     */
    public function withGitRepo(string $gitRepo): self
    {
        $self = clone $this;
        $self['gitRepo'] = $gitRepo;

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
     * Custom build command.
     */
    public function withBuildCommand(string $buildCommand): self
    {
        $self = clone $this;
        $self['buildCommand'] = $buildCommand;

        return $self;
    }

    /**
     * Environment variables to set on the project.
     *
     * @param list<EnvironmentVariable|EnvironmentVariableShape> $environmentVariables
     */
    public function withEnvironmentVariables(array $environmentVariables): self
    {
        $self = clone $this;
        $self['environmentVariables'] = $environmentVariables;

        return $self;
    }

    /**
     * Framework (e.g., "nextjs", "remix", "astro").
     */
    public function withFramework(string $framework): self
    {
        $self = clone $this;
        $self['framework'] = $framework;

        return $self;
    }

    /**
     * Git branch to deploy.
     */
    public function withGitBranch(string $gitBranch): self
    {
        $self = clone $this;
        $self['gitBranch'] = $gitBranch;

        return $self;
    }

    /**
     * Custom install command.
     */
    public function withInstallCommand(string $installCommand): self
    {
        $self = clone $this;
        $self['installCommand'] = $installCommand;

        return $self;
    }

    /**
     * Build output directory.
     */
    public function withOutputDirectory(string $outputDirectory): self
    {
        $self = clone $this;
        $self['outputDirectory'] = $outputDirectory;

        return $self;
    }

    /**
     * Root directory of the project.
     */
    public function withRootDirectory(string $rootDirectory): self
    {
        $self = clone $this;
        $self['rootDirectory'] = $rootDirectory;

        return $self;
    }
}
