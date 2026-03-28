<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\MatterParties\MatterPartyCreateParams\Role;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface MatterPartiesContract
{
    /**
     * @api
     *
     * @param Role|value-of<Role> $role
     * @param array<string,mixed>|null $customFields
     * @param array<string,mixed> $metadata
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $partyID,
        Role|string $role,
        ?array $customFields = null,
        ?bool $isPrimary = null,
        ?array $metadata = null,
        ?string $notes = null,
        ?bool $setAsClient = null,
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
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
