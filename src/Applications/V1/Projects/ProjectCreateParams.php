<?php

declare(strict_types=1);

namespace CaseDev\Applications\V1\Projects;

use CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable;
use CaseDev\Core\Attributes\Optional;
use CaseDev\Core\Attributes\Required;
use CaseDev\Core\Concerns\SdkModel;
use CaseDev\Core\Concerns\SdkParams;
use CaseDev\Core\Contracts\BaseModel;

/**
 * Creates a new application project, validates GitHub access, provisions a default case.dev domain, and starts the deployment workflow. The initial response returns as soon as the workflow is queued so clients can poll for progress.
 *
 * @see CaseDev\Services\Applications\V1\ProjectsService::create()
 *
 * @phpstan-import-type EnvironmentVariableShape from \CaseDev\Applications\V1\Projects\ProjectCreateParams\EnvironmentVariable
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
     * GitHub repository URL or owner/repo identifier.
     */
    #[Required]
    public string $gitRepo;

    /**
     * Human-readable project name.
     */
    #[Required]
    public string $name;

    /**
     * Custom build command to override the framework default.
     */
    #[Optional]
    public ?string $buildCommand;

    /**
     * Environment variables to create before the first deployment.
     *
     * @var list<EnvironmentVariable>|null $environmentVariables
     */
    #[Optional(list: EnvironmentVariable::class)]
    public ?array $environmentVariables;

    /**
     * Framework preset for the hosting project, such as nextjs or remix.
     */
    #[Optional]
    public ?string $framework;

    /**
     * Git branch to deploy. Defaults to main.
     */
    #[Optional]
    public ?string $gitBranch;

    /**
     * Custom install command to override the framework default.
     */
    #[Optional]
    public ?string $installCommand;

    /**
     * Build output directory relative to the project root.
     */
    #[Optional]
    public ?string $outputDirectory;

    /**
     * Repository subdirectory that contains the app to deploy.
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
     * GitHub repository URL or owner/repo identifier.
     */
    public function withGitRepo(string $gitRepo): self
    {
        $self = clone $this;
        $self['gitRepo'] = $gitRepo;

        return $self;
    }

    /**
     * Human-readable project name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Custom build command to override the framework default.
     */
    public function withBuildCommand(string $buildCommand): self
    {
        $self = clone $this;
        $self['buildCommand'] = $buildCommand;

        return $self;
    }

    /**
     * Environment variables to create before the first deployment.
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
     * Framework preset for the hosting project, such as nextjs or remix.
     */
    public function withFramework(string $framework): self
    {
        $self = clone $this;
        $self['framework'] = $framework;

        return $self;
    }

    /**
     * Git branch to deploy. Defaults to main.
     */
    public function withGitBranch(string $gitBranch): self
    {
        $self = clone $this;
        $self['gitBranch'] = $gitBranch;

        return $self;
    }

    /**
     * Custom install command to override the framework default.
     */
    public function withInstallCommand(string $installCommand): self
    {
        $self = clone $this;
        $self['installCommand'] = $installCommand;

        return $self;
    }

    /**
     * Build output directory relative to the project root.
     */
    public function withOutputDirectory(string $outputDirectory): self
    {
        $self = clone $this;
        $self['outputDirectory'] = $outputDirectory;

        return $self;
    }

    /**
     * Repository subdirectory that contains the app to deploy.
     */
    public function withRootDirectory(string $rootDirectory): self
    {
        $self = clone $this;
        $self['rootDirectory'] = $rootDirectory;

        return $self;
    }
}
