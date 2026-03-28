<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters\V1;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\MatterParties\MatterPartyCreateParams\Role;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1\MatterPartiesContract;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class MatterPartiesService implements MatterPartiesContract
{
    /**
     * @api
     */
    public MatterPartiesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MatterPartiesRawService($client);
    }

    /**
     * @api
     *
     * Attach a reusable party to a matter with a matter-specific role.
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
    ): mixed {
        $params = Util::removeNulls(
            [
                'partyID' => $partyID,
                'role' => $role,
                'customFields' => $customFields,
                'isPrimary' => $isPrimary,
                'metadata' => $metadata,
                'notes' => $notes,
                'setAsClient' => $setAsClient,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List parties attached to a matter.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
