<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Format\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\Templates\TemplateCreateParams\Type;
use Casedev\Format\V1\Templates\TemplateNewResponse;
use Casedev\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
interface TemplatesContract
{
    /**
     * @api
     *
     * @param string $content Template content with {{variable}} placeholders
     * @param string $name Template name
     * @param Type|value-of<Type> $type Template type
     * @param string $description Template description
     * @param mixed $styles CSS styles for the template
     * @param list<string> $tags Template tags for organization
     * @param list<string> $variables Template variables (auto-detected if not provided)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $content,
        string $name,
        Type|string $type,
        ?string $description = null,
        mixed $styles = null,
        ?array $tags = null,
        ?array $variables = null,
        RequestOptions|array|null $requestOptions = null,
    ): TemplateNewResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the format template
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
     * @param string $type Filter templates by type (e.g., contract, pleading, letter)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
