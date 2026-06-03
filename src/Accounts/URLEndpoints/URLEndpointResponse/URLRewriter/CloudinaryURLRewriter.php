<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointResponse\URLRewriter;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type CloudinaryURLRewriterShape = array{
 *   preserveAssetDeliveryTypes: bool, type: 'CLOUDINARY'
 * }
 */
final class CloudinaryURLRewriter implements BaseModel
{
    /** @use SdkModel<CloudinaryURLRewriterShape> */
    use SdkModel;

    /** @var 'CLOUDINARY' $type */
    #[Required]
    public string $type = 'CLOUDINARY';

    /**
     * Whether to preserve `<asset_type>/<delivery_type>` in the rewritten URL.
     */
    #[Required('preserve_asset_delivery_types')]
    public bool $preserveAssetDeliveryTypes;

    /**
     * `new CloudinaryURLRewriter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CloudinaryURLRewriter::with(preserveAssetDeliveryTypes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CloudinaryURLRewriter)->withPreserveAssetDeliveryTypes(...)
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
        $self = new self;

        $self['preserveAssetDeliveryTypes'] = $preserveAssetDeliveryTypes;

        return $self;
    }

    /**
     * Whether to preserve `<asset_type>/<delivery_type>` in the rewritten URL.
     */
    public function withPreserveAssetDeliveryTypes(
        bool $preserveAssetDeliveryTypes
    ): self {
        $self = clone $this;
        $self['preserveAssetDeliveryTypes'] = $preserveAssetDeliveryTypes;

        return $self;
    }

    /**
     * @param 'CLOUDINARY' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
