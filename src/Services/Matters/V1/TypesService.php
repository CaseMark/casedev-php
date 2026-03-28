<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\Types\TypeCreateParams\OrchestrationMode;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\TypesContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class TypesService implements TypesContract
{
    /**
     * @api
     */
    public TypesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TypesRawService($client);
    }

    /**
     * @api
     *
     * Create a matter type with plain-English operating instructions and seeded work.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'defaultAgentTypeID' => $defaultAgentTypeID,
                'defaultMetadata' => $defaultMetadata,
                'defaultWorkItems' => $defaultWorkItems,
                'description' => $description,
                'exitCriteria' => $exitCriteria,
                'instructions' => $instructions,
                'intakeRequirements' => $intakeRequirements,
                'isActive' => $isActive,
                'orchestrationMode' => $orchestrationMode,
                'reviewAgentTypeID' => $reviewAgentTypeID,
                'reviewCriteria' => $reviewCriteria,
                'skillRefs' => $skillRefs,
                'slug' => $slug,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a single matter type.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a matter type.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'defaultAgentTypeID' => $defaultAgentTypeID,
                'defaultMetadata' => $defaultMetadata,
                'defaultWorkItems' => $defaultWorkItems,
                'description' => $description,
                'exitCriteria' => $exitCriteria,
                'instructions' => $instructions,
                'intakeRequirements' => $intakeRequirements,
                'isActive' => $isActive,
                'name' => $name,
                'orchestrationMode' => $orchestrationMode,
                'reviewAgentTypeID' => $reviewAgentTypeID,
                'reviewCriteria' => $reviewCriteria,
                'skillRefs' => $skillRefs,
                'slug' => $slug,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List matter types for the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?bool $active = null,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['active' => $active]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
