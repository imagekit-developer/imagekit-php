<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post\AdaptiveBitrateStreaming\Protocol;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AdaptiveBitrateStreamingShape = array{
 *   protocol: Protocol|value-of<Protocol>, type: 'abs', value: string
 * }
 */
final class AdaptiveBitrateStreaming implements BaseModel
{
    /** @use SdkModel<AdaptiveBitrateStreamingShape> */
    use SdkModel;

    /**
     * Adaptive Bitrate Streaming (ABS) setup.
     *
     * @var 'abs' $type
     */
    #[Required]
    public string $type = 'abs';

    /**
     * Streaming protocol to use (`hls` or `dash`).
     *
     * @var value-of<Protocol> $protocol
     */
    #[Required(enum: Protocol::class)]
    public string $protocol;

    /**
     * List of different representations you want to create separated by an underscore.
     */
    #[Required]
    public string $value;

    /**
     * `new AdaptiveBitrateStreaming()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AdaptiveBitrateStreaming::with(protocol: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AdaptiveBitrateStreaming)->withProtocol(...)->withValue(...)
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
        $self = new self;

        $self['protocol'] = $protocol;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Streaming protocol to use (`hls` or `dash`).
     *
     * @param Protocol|value-of<Protocol> $protocol
     */
    public function withProtocol(Protocol|string $protocol): self
    {
        $self = clone $this;
        $self['protocol'] = $protocol;

        return $self;
    }

    /**
     * Adaptive Bitrate Streaming (ABS) setup.
     *
     * @param 'abs' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * List of different representations you want to create separated by an underscore.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
