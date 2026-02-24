<?php

declare(strict_types=1);

namespace CaseDev;

use CaseDev\Core\BaseClient;
use CaseDev\Core\Util;
use CaseDev\Services\AgentService;
use CaseDev\Services\ApplicationsService;
use CaseDev\Services\ComputeService;
use CaseDev\Services\DatabaseService;
use CaseDev\Services\FormatService;
use CaseDev\Services\LegalService;
use CaseDev\Services\LlmService;
use CaseDev\Services\MemoryService;
use CaseDev\Services\OcrService;
use CaseDev\Services\PrivilegeService;
use CaseDev\Services\SearchService;
use CaseDev\Services\SuperdocService;
use CaseDev\Services\SystemService;
use CaseDev\Services\TranslateService;
use CaseDev\Services\VaultService;
use CaseDev\Services\VoiceService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \CaseDev\Core\BaseClient
 * @phpstan-import-type RequestOpts from \CaseDev\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public AgentService $agent;

    /**
     * @api
     */
    public SystemService $system;

    /**
     * @api
     */
    public ApplicationsService $applications;

    /**
     * @api
     */
    public ComputeService $compute;

    /**
     * @api
     */
    public DatabaseService $database;

    /**
     * @api
     */
    public FormatService $format;

    /**
     * @api
     */
    public LegalService $legal;

    /**
     * @api
     */
    public LlmService $llm;

    /**
     * @api
     */
    public MemoryService $memory;

    /**
     * @api
     */
    public OcrService $ocr;

    /**
     * @api
     */
    public PrivilegeService $privilege;

    /**
     * @api
     */
    public SearchService $search;

    /**
     * @api
     */
    public SuperdocService $superdoc;

    /**
     * @api
     */
    public TranslateService $translate;

    /**
     * @api
     */
    public VaultService $vault;

    /**
     * @api
     */
    public VoiceService $voice;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('CASEDEV_API_KEY'));

        $baseUrl ??= Util::getenv('CASEDEV_BASE_URL') ?: 'https://api.case.dev';

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
                'X-Stainless-Package-Version' => '0.1.1',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
        );

        $this->agent = new AgentService($this);
        $this->system = new SystemService($this);
        $this->applications = new ApplicationsService($this);
        $this->compute = new ComputeService($this);
        $this->database = new DatabaseService($this);
        $this->format = new FormatService($this);
        $this->legal = new LegalService($this);
        $this->llm = new LlmService($this);
        $this->memory = new MemoryService($this);
        $this->ocr = new OcrService($this);
        $this->privilege = new PrivilegeService($this);
        $this->search = new SearchService($this);
        $this->superdoc = new SuperdocService($this);
        $this->translate = new TranslateService($this);
        $this->vault = new VaultService($this);
        $this->voice = new VoiceService($this);
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
