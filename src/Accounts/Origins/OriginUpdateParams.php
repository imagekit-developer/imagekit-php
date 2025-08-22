<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins;

use ImageKit\Accounts\Origins\OriginUpdateParams\Body;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Updates the origin identified by `id` and returns the updated origin object.
 *
 * @phpstan-type update_params = array{body: Body}
 */
final class OriginUpdateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    #[Api]
    public Body $body;

    /**
     * `new OriginUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OriginUpdateParams::with(body: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OriginUpdateParams)->withBody(...)
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
     */
    public static function with(Body $body): self
    {
        $obj = new self;

        $obj->body = $body;

        return $obj;
    }

    public function withBody(Body $body): self
    {
        $obj = clone $this;
        $obj->body = $body;

        return $obj;
    }
}
