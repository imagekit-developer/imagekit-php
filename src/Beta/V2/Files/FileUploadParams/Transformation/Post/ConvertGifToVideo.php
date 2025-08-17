<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\ConvertGifToVideo\Type;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type convert_gif_to_video_alias = array{type: Type::*, value?: string}
 */
final class ConvertGifToVideo implements BaseModel
{
    use Model;

    /**
     * Converts an animated GIF into an MP4.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Optional transformation string to apply to the output video.
     * **Example**: `q-80`.
     */
    #[Api(optional: true)]
    public ?string $value;

    /**
     * `new ConvertGifToVideo()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConvertGifToVideo::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConvertGifToVideo)->withType(...)
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
    public static function with(string $type, ?string $value = null): self
    {
        $obj = new self;

        $obj->type = $type;

        null !== $value && $obj->value = $value;

        return $obj;
    }

    /**
     * Converts an animated GIF into an MP4.
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
