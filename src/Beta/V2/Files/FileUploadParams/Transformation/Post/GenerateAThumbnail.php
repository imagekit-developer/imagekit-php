<?php

declare(strict_types=1);

namespace Imagekit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type GenerateAThumbnailShape = array{
 *   type?: 'thumbnail', value?: string|null
 * }
 */
final class GenerateAThumbnail implements BaseModel
{
    /** @use SdkModel<GenerateAThumbnailShape> */
    use SdkModel;

    /**
     * Generates a thumbnail image.
     *
     * @var 'thumbnail' $type
     */
    #[Required]
    public string $type = 'thumbnail';

    /**
     * Optional transformation string.
     * **Example**: `w-150,h-150`.
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
     * Optional transformation string.
     * **Example**: `w-150,h-150`.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
