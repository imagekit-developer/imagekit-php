<?php

declare(strict_types=1);

namespace ImageKit\Responses\Accounts\URLEndpoints\URLEndpointGetResponse\URLRewriter;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Accounts\URLEndpoints\URLEndpointGetResponse\URLRewriter\CloudinaryURLRewriter\Type;

/**
 * @phpstan-type cloudinary_url_rewriter_alias = array{
 *   preserveAssetDeliveryTypes: bool, type: Type::*
 * }
 */
final class CloudinaryURLRewriter implements BaseModel
{
    use Model;

    /**
     * Whether to preserve `<asset_type>/<delivery_type>` in the rewritten URL.
     */
    #[Api]
    public bool $preserveAssetDeliveryTypes;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * `new CloudinaryURLRewriter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CloudinaryURLRewriter::with(preserveAssetDeliveryTypes: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CloudinaryURLRewriter)->withPreserveAssetDeliveryTypes(...)->withType(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type::* $type
     */
    public static function with(
        string $type,
        bool $preserveAssetDeliveryTypes = false
    ): self {
        $obj = new self;

        $obj->preserveAssetDeliveryTypes = $preserveAssetDeliveryTypes;
        $obj->type = $type;

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

    /**
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
