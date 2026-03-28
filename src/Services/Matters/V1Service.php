<?php

declare(strict_types=1);

namespace CaseDev\Services\Matters;

use CaseDev\Client;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Core\Util;
use CaseDev\Matters\V1\V1CreateParams\Status;
use CaseDev\Matters\V1\V1CreateParams\Vault;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Matters\V1Contract;
use CaseDev\Services\Matters\V1\AgentTypesService;
use CaseDev\Services\Matters\V1\EventsService;
use CaseDev\Services\Matters\V1\LogService;
use CaseDev\Services\Matters\V1\MatterPartiesService;
use CaseDev\Services\Matters\V1\PartiesService;
use CaseDev\Services\Matters\V1\SharesService;
use CaseDev\Services\Matters\V1\TypesService;
use CaseDev\Services\Matters\V1\WorkItemsService;

/**
 * Matter-native legal workspaces and orchestration primitives.
 *
 * @phpstan-import-type VaultShape from \CaseDev\Matters\V1\V1CreateParams\Vault
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class V1Service implements V1Contract
{
    /**
     * @api
     */
    public V1RawService $raw;

    /**
     * @api
     */
    public AgentTypesService $agentTypes;

    /**
     * @api
     */
    public PartiesService $parties;

    /**
     * @api
     */
    public TypesService $types;

    /**
     * @api
     */
    public EventsService $events;

    /**
     * @api
     */
    public LogService $log;

    /**
     * @api
     */
    public MatterPartiesService $matterParties;

    /**
     * @api
     */
    public SharesService $shares;

    /**
     * @api
     */
    public WorkItemsService $workItems;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new V1RawService($client);
        $this->agentTypes = new AgentTypesService($client);
        $this->parties = new PartiesService($client);
        $this->types = new TypesService($client);
        $this->events = new EventsService($client);
        $this->log = new LogService($client);
        $this->matterParties = new MatterPartiesService($client);
        $this->shares = new SharesService($client);
        $this->workItems = new WorkItemsService($client);
    }

    /**
     * @api
     *
     * Create a new legal matter and provision its primary vault.
     *
     * @param array<string,mixed> $billing
     * @param array<string,mixed> $customFields
     * @param array<string,mixed> $importantDates
     * @param array<string,mixed> $jurisdiction
     * @param array<string,mixed> $metadata
     * @param Status|value-of<Status> $status
     * @param Vault|VaultShape $vault
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $title,
        ?array $billing = null,
        ?string $clientName = null,
        ?string $clientPartyID = null,
        ?array $customFields = null,
        ?string $description = null,
        ?string $displayID = null,
        ?array $importantDates = null,
        ?array $jurisdiction = null,
        ?string $matterType = null,
        ?array $metadata = null,
        ?string $practiceArea = null,
        ?string $responsibleAttorneyID = null,
        Status|string|null $status = null,
        ?string $subtype = null,
        Vault|array|null $vault = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'title' => $title,
                'billing' => $billing,
                'clientName' => $clientName,
                'clientPartyID' => $clientPartyID,
                'customFields' => $customFields,
                'description' => $description,
                'displayID' => $displayID,
                'importantDates' => $importantDates,
                'jurisdiction' => $jurisdiction,
                'matterType' => $matterType,
                'metadata' => $metadata,
                'practiceArea' => $practiceArea,
                'responsibleAttorneyID' => $responsibleAttorneyID,
                'status' => $status,
                'subtype' => $subtype,
                'vault' => $vault,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a single matter by ID.
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
     * Update mutable matter fields.
     *
     * @param array<string,mixed> $billing
     * @param array<string,mixed> $customFields
     * @param array<string,mixed> $importantDates
     * @param array<string,mixed> $jurisdiction
     * @param array<string,mixed> $metadata
     * @param \CaseDev\Matters\V1\V1UpdateParams\Status|value-of<\CaseDev\Matters\V1\V1UpdateParams\Status> $status
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        ?\DateTimeInterface $archivedAt = null,
        ?array $billing = null,
        ?string $clientName = null,
        ?string $clientPartyID = null,
        ?array $customFields = null,
        ?string $description = null,
        ?string $displayID = null,
        ?array $importantDates = null,
        ?array $jurisdiction = null,
        ?string $matterType = null,
        ?array $metadata = null,
        ?string $practiceArea = null,
        ?string $responsibleAttorneyID = null,
        \CaseDev\Matters\V1\V1UpdateParams\Status|string|null $status = null,
        ?string $subtype = null,
        ?string $title = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'archivedAt' => $archivedAt,
                'billing' => $billing,
                'clientName' => $clientName,
                'clientPartyID' => $clientPartyID,
                'customFields' => $customFields,
                'description' => $description,
                'displayID' => $displayID,
                'importantDates' => $importantDates,
                'jurisdiction' => $jurisdiction,
                'matterType' => $matterType,
                'metadata' => $metadata,
                'practiceArea' => $practiceArea,
                'responsibleAttorneyID' => $responsibleAttorneyID,
                'status' => $status,
                'subtype' => $subtype,
                'title' => $title,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List matters for the authenticated organization.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $matterType = null,
        ?string $practiceArea = null,
        ?string $query = null,
        ?string $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(
            [
                'matterType' => $matterType,
                'practiceArea' => $practiceArea,
                'query' => $query,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
