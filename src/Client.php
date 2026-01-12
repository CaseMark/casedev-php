<?php

declare(strict_types=1);

namespace Casedev;

use Casedev\Core\BaseClient;
use Casedev\Core\Util;
use Casedev\Services\ComputeService;
use Casedev\Services\FormatService;
use Casedev\Services\LlmService;
use Casedev\Services\OcrService;
use Casedev\Services\SearchService;
use Casedev\Services\VaultService;
use Casedev\Services\VoiceService;
use Casedev\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Casedev\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Casedev\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public ComputeService $compute;

    /**
     * @api
     */
    public FormatService $format;

    /**
     * @api
     */
    public LlmService $llm;

    /**
     * @api
     */
    public OcrService $ocr;

    /**
     * @api
     */
    public SearchService $search;

    /**
     * @api
     */
    public VaultService $vault;

    /**
     * @api
     */
    public VoiceService $voice;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? getenv('CASEDEV_API_KEY'));

        $baseUrl ??= getenv('CASEDEV_BASE_URL') ?: 'https://api.case.dev';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('casedev/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.0.1',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
        );

        $this->compute = new ComputeService($this);
        $this->format = new FormatService($this);
        $this->llm = new LlmService($this);
        $this->ocr = new OcrService($this);
        $this->search = new SearchService($this);
        $this->vault = new VaultService($this);
        $this->voice = new VoiceService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
