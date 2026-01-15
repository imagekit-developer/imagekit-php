<?php

declare(strict_types=1);

namespace Imagekit\Services;

use Imagekit\Client;
use Imagekit\Core\Exceptions\APIException;
use Imagekit\Core\Util;
use Imagekit\ExtensionConfig\AITasksExtension;
use Imagekit\ExtensionConfig\AutoDescriptionExtension;
use Imagekit\ExtensionConfig\AutoTaggingExtension;
use Imagekit\ExtensionConfig\RemovedotBgExtension;
use Imagekit\RequestOptions;
use Imagekit\SavedExtension;
use Imagekit\ServiceContracts\SavedExtensionsContract;

/**
 * @phpstan-import-type ExtensionConfigShape from \Imagekit\ExtensionConfig
 * @phpstan-import-type RequestOpts from \Imagekit\RequestOptions
 */
final class SavedExtensionsService implements SavedExtensionsContract
{
    /**
     * @api
     */
    public SavedExtensionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SavedExtensionsRawService($client);
    }

    /**
     * @api
     *
     * This API creates a new saved extension. Saved extensions allow you to save complex extension configurations (like AI tasks) and reuse them by referencing the ID in upload or update file APIs.
     *
     * **Saved extension limit** \
     * You can create a maximum of 100 saved extensions per account.
     *
     * @param ExtensionConfigShape $config configuration object for an extension (base extensions only, not saved extension references)
     * @param string $description description of what the saved extension does
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
    ): SavedExtension {
        $params = Util::removeNulls(
            ['config' => $config, 'description' => $description, 'name' => $name]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API updates an existing saved extension. You can update the name, description, or config.
     *
     * @param string $id the unique ID of the saved extension
     * @param ExtensionConfigShape $config configuration object for an extension (base extensions only, not saved extension references)
     * @param string $description updated description of the saved extension
     * @param string $name updated name of the saved extension
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
    ): SavedExtension {
        $params = Util::removeNulls(
            ['config' => $config, 'description' => $description, 'name' => $name]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API returns an array of all saved extensions for your account. Saved extensions allow you to save complex extension configurations and reuse them by referencing them by ID in upload or update file APIs.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<SavedExtension>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API deletes a saved extension permanently.
     *
     * @param string $id the unique ID of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This API returns details of a specific saved extension by ID.
     *
     * @param string $id the unique ID of the saved extension
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function get(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): SavedExtension {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->get($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
