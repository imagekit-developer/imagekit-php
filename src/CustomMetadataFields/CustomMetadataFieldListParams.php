<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API returns the array of created custom metadata field objects. By default the API returns only non deleted field objects, but you can include deleted fields in the API response.
 *
 * @phpstan-type list_params = array{includeDeleted?: bool}
 */
final class CustomMetadataFieldListParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * Set it to `true` to include deleted field objects in the API response. Default value is `false`.
     */
    #[Api(optional: true)]
    public ?bool $includeDeleted;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function from(?bool $includeDeleted = null): self
    {
        $obj = new self;

        null !== $includeDeleted && $obj->includeDeleted = $includeDeleted;

        return $obj;
    }

    /**
     * Set it to `true` to include deleted field objects in the API response. Default value is `false`.
     */
    public function setIncludeDeleted(bool $includeDeleted): self
    {
        $this->includeDeleted = $includeDeleted;

        return $this;
    }
}
