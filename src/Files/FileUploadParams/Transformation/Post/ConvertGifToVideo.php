<?php

declare(strict_types=1);

namespace Imagekit\Files\FileUploadParams\Transformation\Post;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ConvertGifToVideoShape = array{
 *   type: 'gif-to-video', value?: string|null
 * }
 */
final class ConvertGifToVideo implements BaseModel
{
    /** @use SdkModel<ConvertGifToVideoShape> */
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
        $self = new self;

        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * Optional transformation string to apply to the output video.
     * **Example**: `q-80`.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
