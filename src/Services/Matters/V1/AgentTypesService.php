<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\AgentTypesContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class AgentTypesService implements AgentTypesContract
{
    /**
     * @api
     */
    public AgentTypesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AgentTypesRawService($client);
    }

    /**
     * @api
     *
     * Create a reusable agent role for legal matter orchestration.
     *
     * @param list<string> $disabledTools
     * @param list<string> $enabledTools
     * @param array<string,mixed> $metadata
     * @param list<string> $skillRefs
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $instructions,
        string $name,
        ?string $description = null,
        ?array $disabledTools = null,
        ?array $enabledTools = null,
        ?bool $isActive = null,
        ?bool $isDefault = null,
        ?array $metadata = null,
        ?string $model = null,
        ?array $skillRefs = null,
        ?string $slug = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'instructions' => $instructions,
                'name' => $name,
                'description' => $description,
                'disabledTools' => $disabledTools,
                'enabledTools' => $enabledTools,
                'isActive' => $isActive,
                'isDefault' => $isDefault,
                'metadata' => $metadata,
                'model' => $model,
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
     * List reusable agent roles for the authenticated organization.
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
