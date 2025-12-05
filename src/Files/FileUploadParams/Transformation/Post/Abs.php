<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\FileUploadParams\Transformation\Post\Abs\Protocol;

/**
 * @phpstan-type AbsShape = array{
 *   protocol: value-of<Protocol>, type: 'abs', value: string
 * }
 */
final class Abs implements BaseModel
{
    /** @use SdkModel<AbsShape> */
    use SdkModel;

    /**
     * Adaptive Bitrate Streaming (ABS) setup.
     *
     * @var 'abs' $type
     */
    #[Api]
    public string $type = 'abs';

    /**
     * Streaming protocol to use (`hls` or `dash`).
     *
     * @var value-of<Protocol> $protocol
     */
    #[Api(enum: Protocol::class)]
    public string $protocol;

    /**
     * List of different representations you want to create separated by an underscore.
     */
    #[Api]
    public string $value;

    /**
     * `new Abs()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Abs::with(protocol: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Abs)->withProtocol(...)->withValue(...)
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
     *
     * @param Protocol|value-of<Protocol> $protocol
     */
    public static function with(Protocol|string $protocol, string $value): self
    {
        $obj = new self;

        $obj['protocol'] = $protocol;
        $obj['value'] = $value;

        return $obj;
    }

    /**
     * Streaming protocol to use (`hls` or `dash`).
     *
     * @param Protocol|value-of<Protocol> $protocol
     */
    public function withProtocol(Protocol|string $protocol): self
    {
        $obj = clone $this;
        $obj['protocol'] = $protocol;

        return $obj;
    }

    /**
     * List of different representations you want to create separated by an underscore.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj['value'] = $value;

        return $obj;
    }
}
