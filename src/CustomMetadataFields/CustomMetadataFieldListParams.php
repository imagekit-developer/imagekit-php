<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new CustomMetadataFieldListParams); // set properties as needed
 * $client->customMetadataFields->list(...$params->toArray());
 * ```
 * This API returns the array of created custom metadata field objects. By default the API returns only non deleted field objects, but you can include deleted fields in the API response.
 *
 * You can also filter results by a specific folder path to retrieve custom metadata fields applicable at that location. This path-specific filtering is useful when using the **Path policy** feature to determine which custom metadata fields are selected for a given path.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->customMetadataFields->list(...$params->toArray());`
 *
 * @see ImageKit\CustomMetadataFields->list
 *
 * @phpstan-type custom_metadata_field_list_params = array{
 *   folderPath?: string, includeDeleted?: bool
 * }
 */
final class CustomMetadataFieldListParams implements BaseModel
{
    /** @use SdkModel<custom_metadata_field_list_params> */
    use SdkModel;
    use SdkParams;

    /**
     * The folder path (e.g., `/path/to/folder`) for which to retrieve applicable custom metadata fields. Useful for determining path-specific field selections when the [Path policy](https://imagekit.io/docs/dam/path-policy) feature is in use.
     */
    #[Api(optional: true)]
    public ?string $folderPath;

    /**
     * Set it to `true` to include deleted field objects in the API response.
     */
    #[Api(optional: true)]
    public ?bool $includeDeleted;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $folderPath = null,
        ?bool $includeDeleted = null
    ): self {
        $obj = new self;

        null !== $folderPath && $obj->folderPath = $folderPath;
        null !== $includeDeleted && $obj->includeDeleted = $includeDeleted;

        return $obj;
    }

    /**
     * The folder path (e.g., `/path/to/folder`) for which to retrieve applicable custom metadata fields. Useful for determining path-specific field selections when the [Path policy](https://imagekit.io/docs/dam/path-policy) feature is in use.
     */
    public function withFolderPath(string $folderPath): self
    {
        $obj = clone $this;
        $obj->folderPath = $folderPath;

        return $obj;
    }

    /**
     * Set it to `true` to include deleted field objects in the API response.
     */
    public function withIncludeDeleted(bool $includeDeleted): self
    {
        $obj = clone $this;
        $obj->includeDeleted = $includeDeleted;

        return $obj;
    }
}
