<?php

declare(strict_types=1);

namespace CaseDev\ServiceContracts\Matters\V1;

use CaseDev\Core\Exceptions\APIException;
use CaseDev\Matters\V1\Shares\ShareCreateParams\Permission;
use CaseDev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
interface SharesContract
{
    /**
     * @api
     *
     * @param Permission|value-of<Permission> $permission
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        string $targetOrgID,
        ?\DateTimeInterface $expiresAt = null,
        Permission|string $permission = 'read',
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

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $shareID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}
