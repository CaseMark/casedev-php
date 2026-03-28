<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\V1CreateParams\Status;
use CaseDev\Matters\V1\V1CreateParams\Vault;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type VaultShape from \CaseDev\Matters\V1\V1CreateParams\Vault
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface V1Contract
{
    /**
     * @api
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
    ): mixed;

    /**
     * @api
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
    ): mixed;
}
