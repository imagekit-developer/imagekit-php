<?php

declare(strict_types=1);

namespace ImageKit\ServiceContracts;

use ImageKit\Core\Exceptions\APIException;
use ImageKit\ExtensionConfig\AITasksExtension;
use ImageKit\ExtensionConfig\AutoDescriptionExtension;
use ImageKit\ExtensionConfig\AutoTaggingExtension;
use ImageKit\ExtensionConfig\RemovedotBgExtension;
use ImageKit\RequestOptions;
use ImageKit\SavedExtension;

/**
 * @phpstan-import-type ExtensionConfigShape from \ImageKit\ExtensionConfig
 * @phpstan-import-type RequestOpts from \ImageKit\RequestOptions
 */
interface SavedExtensionsContract
{
    /**
     * @api
     *
     * @param ExtensionConfigShape $config configuration object for an extension (base extensions only, not saved extension references)
     * @param string $description description of the saved extension
     * @param string $name name of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        RemovedotBgExtension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension $config,
        string $description,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): SavedExtension;

    /**
     * @api
     *
     * @param string $id the unique ID of the saved extension
     * @param ExtensionConfigShape $config configuration object for an extension (base extensions only, not saved extension references)
     * @param string $description description of the saved extension
     * @param string $name name of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        RemovedotBgExtension|array|AutoTaggingExtension|AutoDescriptionExtension|AITasksExtension|null $config = null,
        ?string $description = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): SavedExtension;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<SavedExtension>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param string $id the unique ID of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $id the unique ID of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): SavedExtension;
}
