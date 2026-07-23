<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUploadParams\Transformation\Post;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

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
     * Converts an animated GIF into an MP4.
     *
     * @param 'gif-to-video' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

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
