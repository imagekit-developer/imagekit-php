<?php

declare(strict_types=1);

namespace ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter;

use ImageKit\Accounts\URLEndpoints\URLEndpointCreateParams\URLRewriter\AkamaiURLRewriter\Type;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type akamai_url_rewriter_alias = array{type: Type::*}
 */
final class AkamaiURLRewriter implements BaseModel
{
    use SdkModel;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * `new AkamaiURLRewriter()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AkamaiURLRewriter::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AkamaiURLRewriter)->withType(...)
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
    public static function with(string $type): self
    {
        $obj = new self;

        $obj->type = $type;

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
