<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type thumbnail_alias = array{type: string, value?: string}
 */
final class Thumbnail implements BaseModel
{
    /** @use SdkModel<thumbnail_alias> */
    use SdkModel;

    /**
     * Generates a thumbnail image.
     */
    #[Api]
    public string $type = 'thumbnail';

    /**
     * Optional transformation string.
     * **Example**: `w-150,h-150`.
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
     * Optional transformation string.
     * **Example**: `w-150,h-150`.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
