<?php

declare(strict_types=1);

namespace Casedev\Services\Format\V1;

use Casedev\Client;
use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\Templates\TemplateCreateParams\Type;
use Casedev\Format\V1\Templates\TemplateNewResponse;
use Casedev\RequestOptions;
use Casedev\ServiceContracts\Format\V1\TemplatesContract;

final class TemplatesService implements TemplatesContract
{
    /**
     * @api
     */
    public TemplatesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TemplatesRawService($client);
    }

    /**
     * @api
     *
     * Create a new format template for document formatting. Templates support variables using `{{variable}}` syntax and can be used for captions, signatures, letterheads, certificates, footers, or custom formatting needs.
     *
     * @param string $content Template content with {{variable}} placeholders
     * @param string $name Template name
     * @param 'caption'|'signature'|'letterhead'|'certificate'|'footer'|'custom'|Type $type Template type
     * @param string $description Template description
     * @param mixed $styles CSS styles for the template
     * @param list<string> $tags Template tags for organization
     * @param list<string> $variables Template variables (auto-detected if not provided)
     *
     * @throws APIException
     */
    public function create(
        string $content,
        string $name,
        string|Type $type,
        ?string $description = null,
        mixed $styles = null,
        ?array $tags = null,
        ?array $variables = null,
        ?RequestOptions $requestOptions = null,
    ): TemplateNewResponse {
        $params = [
            'content' => $content,
            'name' => $name,
            'type' => $type,
            'description' => $description,
            'styles' => $styles,
            'tags' => $tags,
            'variables' => $variables,
        ];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a specific document format template by ID. Format templates define how documents should be structured and formatted for specific legal use cases such as contracts, briefs, or pleadings.
     *
     * @param string $id The unique identifier of the format template
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve all format templates for the organization. Templates define reusable document formatting patterns with customizable variables for consistent legal document generation.
     *
     * Filter by type to get specific template categories like contracts, pleadings, or correspondence.
     *
     * @param string $type Filter templates by type (e.g., contract, pleading, letter)
     *
     * @throws APIException
     */
    public function list(
        ?string $type = null,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['type' => $type];
        // @phpstan-ignore-next-line function.impossibleType
        $params = array_filter($params, callback: static fn ($v) => !is_null($v));

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
