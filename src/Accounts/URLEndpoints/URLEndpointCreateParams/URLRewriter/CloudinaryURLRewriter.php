<?php

declare(strict_types=1);

namespace Imagekit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type CloudinaryURLRewriterShape = array{
 *   type?: 'CLOUDINARY', preserveAssetDeliveryTypes?: bool|null
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
    #[Optional]
    public ?bool $preserveAssetDeliveryTypes;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $preserveAssetDeliveryTypes = null): self
    {
        $self = new self;

        null !== $preserveAssetDeliveryTypes && $self['preserveAssetDeliveryTypes'] = $preserveAssetDeliveryTypes;

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
}
