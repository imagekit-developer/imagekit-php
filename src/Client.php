<?php

declare(strict_types=1);

namespace ImageKit;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use ImageKit\Core\BaseClient;
use ImageKit\Services\AccountsService;
use ImageKit\Services\AssetsService;
use ImageKit\Services\BetaService;
use ImageKit\Services\CacheService;
use ImageKit\Services\CustomMetadataFieldsService;
use ImageKit\Services\FilesService;
use ImageKit\Services\FoldersService;
use ImageKit\Services\WebhooksService;

class Client extends BaseClient
{
    public string $privateKey;

    public string $password;

    public bool $baseUrlOverridden;

    /**
     * @api
     */
    public CustomMetadataFieldsService $customMetadataFields;

    /**
     * @api
     */
    public FilesService $files;

    /**
     * @api
     */
    public AssetsService $assets;

    /**
     * @api
     */
    public CacheService $cache;

    /**
     * @api
     */
    public FoldersService $folders;

    /**
     * @api
     */
    public AccountsService $accounts;

    /**
     * @api
     */
    public BetaService $beta;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    public function __construct(
        ?string $privateKey = null,
        ?string $password = null,
        ?string $baseUrl = null,
    ) {
        $this->privateKey = (string) ($privateKey ?? getenv('IMAGEKIT_PRIVATE_KEY'));
        $this->password = (string) ($password ?? getenv('OPTIONAL_IMAGEKIT_IGNORES_THIS') ?: PHP.Literal(do_not_set));

        $this->baseUrlOverridden = !is_null($baseUrl);

        $baseUrl ??= getenv('IMAGE_KIT_BASE_URL') ?: 'https://api.imagekit.io';

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
                'User-Agent' => sprintf('ImageKit/PHP %s', '0.0.1'),
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

        $this->customMetadataFields = new CustomMetadataFieldsService($this);
        $this->files = new FilesService($this);
        $this->assets = new AssetsService($this);
        $this->cache = new CacheService($this);
        $this->folders = new FoldersService($this);
        $this->accounts = new AccountsService($this);
        $this->beta = new BetaService($this);
        $this->webhooks = new WebhooksService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        if (!$this->privateKey && !$this->password) {
            return [];
        }

        $base64_credentials = base64_encode(
            "{$this->privateKey}:{$this->password}"
        );

        return ['Authorization' => "Basic {$base64_credentials}"];
    }
}
