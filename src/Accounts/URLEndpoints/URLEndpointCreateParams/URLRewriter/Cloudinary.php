<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type cloudinary_alias = array{
 *   type: string, preserveAssetDeliveryTypes?: bool|null
 * }
 */
final class Cloudinary implements BaseModel
{
    /** @use SdkModel<cloudinary_alias> */
    use SdkModel;

    #[Api]
    public string $type = 'CLOUDINARY';

    /**
     * Whether to preserve `<asset_type>/<delivery_type>` in the rewritten URL.
     */
    #[Api(optional: true)]
    public ?bool $preserveAssetDeliveryTypes;

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
    public static function with(?bool $preserveAssetDeliveryTypes = null): self
    {
        $obj = new self;

        null !== $preserveAssetDeliveryTypes && $obj->preserveAssetDeliveryTypes = $preserveAssetDeliveryTypes;

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
