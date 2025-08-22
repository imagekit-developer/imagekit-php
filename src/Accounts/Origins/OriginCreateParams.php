<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins;

use ImageKit\Accounts\Origins\OriginCreateParams\Body;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Creates a new origin and returns the origin object.
 *
 * @phpstan-type create_params = array{body: Body}
 */
final class OriginCreateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    #[Api]
    public Body $body;

    /**
     * `new OriginCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OriginCreateParams::with(body: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OriginCreateParams)->withBody(...)
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
