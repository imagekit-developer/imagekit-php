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
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->customMetadataFields->list(...$params->toArray());`
 *
 * @see ImageKit\CustomMetadataFields->list
 *
 * @phpstan-type custom_metadata_field_list_params = array{includeDeleted?: bool}
 */
final class CustomMetadataFieldListParams implements BaseModel
{
    /** @use SdkModel<custom_metadata_field_list_params> */
    use SdkModel;
    use SdkParams;

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
    public static function with(?bool $includeDeleted = null): self
    {
        $obj = new self;

        null !== $includeDeleted && $obj->includeDeleted = $includeDeleted;

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
