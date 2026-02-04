<?php

declare(strict_types=1);

namespace Casedev\Database\V1\V1GetUsageResponse;

use Casedev\Core\Attributes\Optional;
use Casedev\Core\Concerns\SdkModel;
use Casedev\Core\Contracts\BaseModel;
use Casedev\Database\V1\V1GetUsageResponse\Project\Costs;

/**
 * @phpstan-import-type CostsShape from \Casedev\Database\V1\V1GetUsageResponse\Project\Costs
 *
 * @phpstan-type ProjectShape = array{
 *   id?: string|null,
 *   branchCount?: int|null,
 *   computeCuHours?: float|null,
 *   costs?: null|Costs|CostsShape,
 *   lastUpdated?: \DateTimeInterface|null,
 *   projectID?: string|null,
 *   projectName?: string|null,
 *   storageGBMonths?: float|null,
 *   transferGB?: float|null,
 * }
 */
final class Project implements BaseModel
{
    /** @use SdkModel<ProjectShape> */
    use SdkModel;

    #[Optional]
    public ?string $id;

    #[Optional]
    public ?int $branchCount;

    #[Optional]
    public ?float $computeCuHours;

    #[Optional]
    public ?Costs $costs;

    #[Optional]
    public ?\DateTimeInterface $lastUpdated;

    #[Optional('projectId')]
    public ?string $projectID;

    #[Optional(nullable: true)]
    public ?string $projectName;

    #[Optional('storageGbMonths')]
    public ?float $storageGBMonths;

    #[Optional('transferGb')]
    public ?float $transferGB;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Costs|CostsShape|null $costs
     */
    public static function with(
        ?string $id = null,
        ?int $branchCount = null,
        ?float $computeCuHours = null,
        Costs|array|null $costs = null,
        ?\DateTimeInterface $lastUpdated = null,
        ?string $projectID = null,
        ?string $projectName = null,
        ?float $storageGBMonths = null,
        ?float $transferGB = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $branchCount && $self['branchCount'] = $branchCount;
        null !== $computeCuHours && $self['computeCuHours'] = $computeCuHours;
        null !== $costs && $self['costs'] = $costs;
        null !== $lastUpdated && $self['lastUpdated'] = $lastUpdated;
        null !== $projectID && $self['projectID'] = $projectID;
        null !== $projectName && $self['projectName'] = $projectName;
        null !== $storageGBMonths && $self['storageGBMonths'] = $storageGBMonths;
        null !== $transferGB && $self['transferGB'] = $transferGB;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withBranchCount(int $branchCount): self
    {
        $self = clone $this;
        $self['branchCount'] = $branchCount;

        return $self;
    }

    public function withComputeCuHours(float $computeCuHours): self
    {
        $self = clone $this;
        $self['computeCuHours'] = $computeCuHours;

        return $self;
    }

    /**
     * @param Costs|CostsShape $costs
     */
    public function withCosts(Costs|array $costs): self
    {
        $self = clone $this;
        $self['costs'] = $costs;

        return $self;
    }

    public function withLastUpdated(\DateTimeInterface $lastUpdated): self
    {
        $self = clone $this;
        $self['lastUpdated'] = $lastUpdated;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    public function withProjectName(?string $projectName): self
    {
        $self = clone $this;
        $self['projectName'] = $projectName;

        return $self;
    }

    public function withStorageGBMonths(float $storageGBMonths): self
    {
        $self = clone $this;
        $self['storageGBMonths'] = $storageGBMonths;

        return $self;
    }

    public function withTransferGB(float $transferGB): self
    {
        $self = clone $this;
        $self['transferGB'] = $transferGB;

        return $self;
    }
}
