<?php

declare(strict_types=1);

namespace ImageKit;

use ImageKit\Accounts\AccountsService;
use ImageKit\BulkJobs\BulkJobsService;
use ImageKit\Core\BaseClient;
use ImageKit\CustomMetadataFields\CustomMetadataFieldsService;
use ImageKit\Files\FilesService;
use ImageKit\Folder\FolderService;

class Client extends BaseClient
{
    public string $privateAPIKey;

    public string $password;

    public CustomMetadataFieldsService $customMetadataFields;

    public FilesService $files;

    public FolderService $folder;

    public BulkJobsService $bulkJobs;

    public AccountsService $accounts;

    public bool $baseUrlOverridden;

    public function __construct(
        ?string $privateAPIKey = null,
        ?string $password = null,
        ?string $baseUrl = null,
    ) {
        $this->privateAPIKey = (string) (
            $privateAPIKey ?? getenv('IMAGEKIT_PRIVATE_API_KEY')
        );
        $this->password = (string) (
            $password ?? getenv('ORG_MY_PASSWORD_TOKEN') ?: 'does_not_matter'
        );

        $this->baseUrlOverridden = !is_null($baseUrl);

        $base = $baseUrl ?? getenv(
            'IMAGE_KIT_BASE_URL'
        ) ?: 'https://api.imagekit.io';

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json', 'Accept' => 'application/json',
            ],
            baseUrl: $base,
            options: new RequestOptions,
        );

        $this->customMetadataFields = new CustomMetadataFieldsService($this);
        $this->files = new FilesService($this);
        $this->folder = new FolderService($this);
        $this->bulkJobs = new BulkJobsService($this);
        $this->accounts = new AccountsService($this);
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
