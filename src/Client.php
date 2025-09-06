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
    public string $privateAPIKey;

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
        ?string $privateAPIKey = null,
        ?string $password = null,
        ?string $baseUrl = null,
    ) {
        $this->privateAPIKey = (string) (
            $privateAPIKey ?? getenv('IMAGEKIT_PRIVATE_API_KEY')
        );
        $this->password = (string) (
            $password ?? getenv('OPTIONAL_IMAGEKIT_IGNORES_THIS') ?: 'do_not_set'
        );

        $this->baseUrlOverridden = !is_null($baseUrl);

        $base = $baseUrl ?? getenv(
            'IMAGE_KIT_BASE_URL'
        ) ?: 'https://api.imagekit.io';

        $options = RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json', 'Accept' => 'application/json',
            ],
            baseUrl: $base,
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

    /** @return array<string, string> */
    protected function authHeaders(): array
    {
        if (!$this->privateAPIKey && !$this->password) {
            return [];
        }

        $base64_credentials = base64_encode(
            "{$this->privateAPIKey}:{$this->password}"
        );

        return ['Authorization' => "Basic {$base64_credentials}"];
    }
}
