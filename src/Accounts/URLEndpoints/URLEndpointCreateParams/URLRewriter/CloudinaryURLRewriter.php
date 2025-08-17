<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\CloudinaryURLRewriter\Type;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type cloudinary_url_rewriter_alias = array{
 *   type: Type::*, preserveAssetDeliveryTypes?: bool
 * }
 */
final class CloudinaryURLRewriter implements BaseModel
{
    use Model;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Whether to preserve `<asset_type>/<delivery_type>` in the rewritten URL.
     */
    #[Api(optional: true)]
    public ?bool $preserveAssetDeliveryTypes;

    /**
     * `new CloudinaryURLRewriter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CloudinaryURLRewriter::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CloudinaryURLRewriter)->withType(...)
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
        ?bool $preserveAssetDeliveryTypes = null
    ): self {
        $obj = new self;

        $obj->type = $type;

        null !== $preserveAssetDeliveryTypes && $obj->preserveAssetDeliveryTypes = $preserveAssetDeliveryTypes;

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
