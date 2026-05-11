<?php

declare(strict_types=1);

namespace Imagekit;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Imagekit\Core\BaseClient;
use Imagekit\Core\Implementation\StreamingHttpClient;
use Imagekit\Core\Util;
use Imagekit\Services\AccountsService;
use Imagekit\Services\AssetsService;
use Imagekit\Services\BetaService;
use Imagekit\Services\CacheService;
use Imagekit\Services\CustomMetadataFieldsService;
use Imagekit\Services\FilesService;
use Imagekit\Services\FoldersService;
use Imagekit\Services\SavedExtensionsService;
use Imagekit\Services\WebhooksService;

/**
 * @phpstan-import-type NormalizedRequest from \Imagekit\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
class Client extends BaseClient
{
    public string $privateKey;

    public string $password;

    public string $webhookSecret;

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
    public SavedExtensionsService $savedExtensions;

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

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $privateKey = null,
        ?string $password = null,
        ?string $webhookSecret = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->privateKey = (string) ($privateKey ?? Util::getenv(
            'IMAGEKIT_PRIVATE_KEY'
        ));
        $this->password = (string) ($password ?? Util::getenv(
            'OPTIONAL_IMAGEKIT_IGNORES_THIS'
        ) ?: 'do_not_set');
        $this->webhookSecret = (string) ($webhookSecret ?? Util::getenv(
            'IMAGEKIT_WEBHOOK_SECRET'
        ));

        $this->baseUrlOverridden = !is_null($baseUrl);

        $baseUrl ??= Util::getenv(
            'IMAGE_KIT_BASE_URL'
        ) ?: 'https://api.imagekit.io';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('ImageKit/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => '0.0.1',
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('IMAGE_KIT_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options
        );

        $this->customMetadataFields = new CustomMetadataFieldsService($this);
        $this->files = new FilesService($this);
        $this->savedExtensions = new SavedExtensionsService($this);
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
