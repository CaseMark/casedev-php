<?php

declare(strict_types=1);

namespace CaseDev\Services\Privilege;

use CaseDev\Client;
use CaseDev\Core\Contracts\BaseResponse;
use CaseDev\Core\Exceptions\APIException;
use CaseDev\Privilege\V1\V1DetectParams;
use CaseDev\Privilege\V1\V1DetectParams\Category;
use CaseDev\Privilege\V1\V1DetectParams\Jurisdiction;
use CaseDev\Privilege\V1\V1DetectResponse;
use CaseDev\RequestOptions;
use CaseDev\ServiceContracts\Privilege\V1RawContract;

/**
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
final class V1RawService implements V1RawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Analyzes text or vault documents for legal privilege. Detects attorney-client privilege, work product doctrine, common interest privilege, and litigation hold materials.
     *
     * Returns structured privilege flags with confidence scores and policy-friendly rationale suitable for discovery workflows and privilege logs.
     *
     * **Size Limit:** Maximum 200,000 characters (larger documents rejected).
     *
     * **Permissions:** Requires `chat` permission. When using `document_id`, also requires `vault` permission.
     *
     * **Note:** When analyzing vault documents, results are automatically stored in the document's `privilege_analysis` metadata field.
     *
     * @param array{
     *   categories?: list<Category|value-of<Category>>,
     *   content?: string,
     *   documentID?: string,
     *   includeRationale?: bool,
     *   jurisdiction?: Jurisdiction|value-of<Jurisdiction>,
     *   model?: string,
     *   vaultID?: string,
     * }|V1DetectParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<V1DetectResponse>
     *
     * @throws APIException
     */
    public function detect(
        array|V1DetectParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = V1DetectParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'privilege/v1/detect',
            body: (object) $parsed,
            options: $options,
            convert: V1DetectResponse::class,
        );
    }
}
