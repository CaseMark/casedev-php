<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface AgentTypesContract
{
    /**
     * @api
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
