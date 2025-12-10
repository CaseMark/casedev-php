<?php

declare(strict_types=1);

namespace Casedev\ServiceContracts\Format\V1;

use Casedev\Core\Exceptions\APIException;
use Casedev\Format\V1\Templates\TemplateCreateParams\Type;
use Casedev\Format\V1\Templates\TemplateNewResponse;
use Casedev\RequestOptions;

interface TemplatesContract
{
    /**
     * @api
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
    ): TemplateNewResponse;

    /**
     * @api
     *
     * @param string $id The unique identifier of the format template
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $type Filter templates by type (e.g., contract, pleading, letter)
     *
     * @throws APIException
     */
    public function list(
        ?string $type = null,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
