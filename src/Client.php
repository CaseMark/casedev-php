<?php

declare(strict_types=1);

namespace Casedev;

use Casedev\Core\BaseClient;
use Casedev\Services\ActionsService;
use Casedev\Services\ComputeService;
use Casedev\Services\ConvertService;
use Casedev\Services\FormatService;
use Casedev\Services\LlmService;
use Casedev\Services\OcrService;
use Casedev\Services\SearchService;
use Casedev\Services\VaultService;
use Casedev\Services\VoiceService;
use Casedev\Services\WebhooksService;
use Casedev\Services\WorkflowsService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public ActionsService $actions;

    /**
     * @api
     */
    public ComputeService $compute;

    /**
     * @api
     */
    public ConvertService $convert;

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
     * @api
     */
    public WorkflowsService $workflows;

    public function __construct(?string $apiKey = null, ?string $baseUrl = null)
    {
        $this->apiKey = (string) ($apiKey ?? getenv('CASEDEV_API_KEY'));

        $baseUrl ??= getenv('CASEDEV_BASE_URL') ?: 'https://api.case.dev';

        $options = RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        );

        parent::__construct(
            // x-release-please-start-version
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('casedev/PHP %s', '0.0.1'),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.0.1',
                'X-Stainless-OS' => $this->getNormalizedOS(),
                'X-Stainless-Arch' => $this->getNormalizedArchitecture(),
                'X-Stainless-Runtime' => 'php',
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            // x-release-please-end
            baseUrl: $baseUrl,
            options: $options,
        );

        $this->actions = new ActionsService($this);
        $this->compute = new ComputeService($this);
        $this->convert = new ConvertService($this);
        $this->format = new FormatService($this);
        $this->llm = new LlmService($this);
        $this->ocr = new OcrService($this);
        $this->search = new SearchService($this);
        $this->vault = new VaultService($this);
        $this->voice = new VoiceService($this);
        $this->webhooks = new WebhooksService($this);
        $this->workflows = new WorkflowsService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }
}
