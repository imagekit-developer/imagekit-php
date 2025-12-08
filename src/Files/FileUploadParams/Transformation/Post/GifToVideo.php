<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadParams\Transformation\Post;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type GifToVideoShape = array{type: 'gif-to-video', value?: string|null}
 */
final class GifToVideo implements BaseModel
{
    /** @use SdkModel<GifToVideoShape> */
    use SdkModel;

    /**
     * Converts an animated GIF into an MP4.
     *
     * @var 'gif-to-video' $type
     */
    #[Required]
    public string $type = 'gif-to-video';

    /**
     * Optional transformation string to apply to the output video.
     * **Example**: `q-80`.
     */
    #[Optional]
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

        null !== $value && $obj['value'] = $value;

        return $obj;
    }

    /**
     * Optional transformation string to apply to the output video.
     * **Example**: `q-80`.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj['value'] = $value;

        return $obj;
    }
}
