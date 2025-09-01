<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type gif_to_video = array{type: string, value?: string|null}
 */
final class GifToVideo implements BaseModel
{
    /** @use SdkModel<gif_to_video> */
    use SdkModel;

    /**
     * Converts an animated GIF into an MP4.
     */
    #[Api]
    public string $type = 'gif-to-video';

    /**
     * Optional transformation string to apply to the output video.
     * **Example**: `q-80`.
     */
    #[Api(optional: true)]
    public ?string $value;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $value = null): self
    {
        $obj = new self;

        null !== $value && $obj->value = $value;

        return $obj;
    }

    /**
     * Optional transformation string to apply to the output video.
     * **Example**: `q-80`.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
