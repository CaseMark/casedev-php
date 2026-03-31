<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Types\TypeCreateParams\OrchestrationMode;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface TypesContract
{
    /**
     * @api
     *
     * @param array<string,mixed> $defaultMetadata
     * @param list<array<string,mixed>> $defaultWorkItems
     * @param list<string> $exitCriteria
     * @param list<string> $intakeRequirements
     * @param OrchestrationMode|value-of<OrchestrationMode> $orchestrationMode
     * @param list<string> $reviewCriteria
     * @param list<string> $skillRefs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $defaultAgentTypeID = null,
        ?array $defaultMetadata = null,
        ?array $defaultWorkItems = null,
        ?string $description = null,
        ?array $exitCriteria = null,
        ?string $instructions = null,
        ?array $intakeRequirements = null,
        ?bool $isActive = null,
        OrchestrationMode|string|null $orchestrationMode = null,
        ?string $reviewAgentTypeID = null,
        ?array $reviewCriteria = null,
        ?array $skillRefs = null,
        ?string $slug = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<string,mixed> $defaultMetadata
     * @param list<array<string,mixed>> $defaultWorkItems
     * @param list<string> $exitCriteria
     * @param list<string> $intakeRequirements
     * @param \CaseDev\Matters\V1\Types\TypeUpdateParams\OrchestrationMode|value-of<\CaseDev\Matters\V1\Types\TypeUpdateParams\OrchestrationMode> $orchestrationMode
     * @param list<string> $reviewCriteria
     * @param list<string> $skillRefs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?string $defaultAgentTypeID = null,
        ?array $defaultMetadata = null,
        ?array $defaultWorkItems = null,
        ?string $description = null,
        ?array $exitCriteria = null,
        ?string $instructions = null,
        ?array $intakeRequirements = null,
        ?bool $isActive = null,
        ?string $name = null,
        \CaseDev\Matters\V1\Types\TypeUpdateParams\OrchestrationMode|string|null $orchestrationMode = null,
        ?string $reviewAgentTypeID = null,
        ?array $reviewCriteria = null,
        ?array $skillRefs = null,
        ?string $slug = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?bool $active = null,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
