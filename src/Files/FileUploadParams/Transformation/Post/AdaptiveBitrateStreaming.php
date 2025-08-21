<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming\Protocol;
use ImageKit\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming\Type;

/**
 * @phpstan-type adaptive_bitrate_streaming_alias = array{
 *   protocol: Protocol::*, type: Type::*, value: string
 * }
 */
final class AdaptiveBitrateStreaming implements BaseModel
{
    use SdkModel;

    /**
     * Streaming protocol to use (`hls` or `dash`).
     *
     * @var Protocol::* $protocol
     */
    #[Api(enum: Protocol::class)]
    public string $protocol;

    /**
     * Adaptive Bitrate Streaming (ABS) setup.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * List of different representations you want to create separated by an underscore.
     */
    #[Api]
    public string $value;

    /**
     * `new AdaptiveBitrateStreaming()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AdaptiveBitrateStreaming::with(protocol: ..., type: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AdaptiveBitrateStreaming)->withProtocol(...)->withType(...)->withValue(...)
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
     * @param Protocol::* $protocol
     * @param Type::* $type
     */
    public static function with(
        string $protocol,
        string $type,
        string $value
    ): self {
        $obj = new self;

        $obj->protocol = $protocol;
        $obj->type = $type;
        $obj->value = $value;

        return $obj;
    }

    /**
     * Streaming protocol to use (`hls` or `dash`).
     *
     * @param Protocol::* $protocol
     */
    public function withProtocol(string $protocol): self
    {
        $obj = clone $this;
        $obj->protocol = $protocol;

        return $obj;
    }

    /**
     * Adaptive Bitrate Streaming (ABS) setup.
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * List of different representations you want to create separated by an underscore.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
