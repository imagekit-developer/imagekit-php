<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type CloudinaryShape = array{
 *   preserveAssetDeliveryTypes: bool, type: "CLOUDINARY"
 * }
 */
final class Cloudinary implements BaseModel
{
    /** @use SdkModel<CloudinaryShape> */
    use SdkModel;

    /** @var "CLOUDINARY" $type */
    #[Api]
    public string $type = 'CLOUDINARY';

    /**
     * Whether to preserve `<asset_type>/<delivery_type>` in the rewritten URL.
     */
    #[Api]
    public bool $preserveAssetDeliveryTypes;

    /**
     * `new Cloudinary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Cloudinary::with(preserveAssetDeliveryTypes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Cloudinary)->withPreserveAssetDeliveryTypes(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(bool $preserveAssetDeliveryTypes = false): self
    {
        $obj = new self;

        $obj->preserveAssetDeliveryTypes = $preserveAssetDeliveryTypes;

        return $obj;
    }

    /**
     * Whether to preserve `<asset_type>/<delivery_type>` in the rewritten URL.
     */
    public function withPreserveAssetDeliveryTypes(
        bool $preserveAssetDeliveryTypes
    ): self {
        $obj = clone $this;
        $obj->preserveAssetDeliveryTypes = $preserveAssetDeliveryTypes;

        return $obj;
    }
}
