<?php

declare(strict_types=1);

namespace ImageKit\Folder;

use ImageKit\Client;
use ImageKit\Contracts\FolderContract;
use ImageKit\Core\Conversion;
use ImageKit\RequestOptions;

final class FolderService implements FolderContract
{
    public function __construct(private Client $client) {}

    /**
     * This will create a new folder. You can specify the folder name and location of the parent folder where this new folder should be created.
     *
     * @param array{
     *   folderName: string, parentFolderPath: string
     * }|FolderCreateParams $params
     */
    public function create(
        array|FolderCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = FolderCreateParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce('mixed', value: $resp);
    }

    /**
     * This will delete a folder and all its contents permanently. The API returns an empty response.
     *
     * @param array{folderPath: string}|FolderDeleteParams $params
     */
    public function delete(
        array|FolderDeleteParams $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = FolderDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'delete',
            path: 'v1/folder',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce('mixed', value: $resp);
    }
}
