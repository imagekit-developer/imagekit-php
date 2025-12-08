<?php

declare(strict_types=1);

namespace Imagekit\ExtensionItem;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionItem\RemoveBg\Options;

/**
 * @phpstan-type RemoveBgShape = array{name: 'remove-bg', options?: Options|null}
 */
final class RemoveBg implements BaseModel
{
    /** @use SdkModel<RemoveBgShape> */
    use SdkModel;

    /**
     * Specifies the background removal extension.
     *
     * @var 'remove-bg' $name
     */
    #[Required]
    public string $name = 'remove-bg';

    #[Optional]
    public ?Options $options;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Options|array{
     *   add_shadow?: bool|null,
     *   bg_color?: string|null,
     *   bg_image_url?: string|null,
     *   semitransparency?: bool|null,
     * } $options
     */
    public static function with(Options|array|null $options = null): self
    {
        $obj = new self;

        null !== $options && $obj['options'] = $options;

        return $obj;
    }

    /**
     * @param Options|array{
     *   add_shadow?: bool|null,
     *   bg_color?: string|null,
     *   bg_image_url?: string|null,
     *   semitransparency?: bool|null,
     * } $options
     */
    public function withOptions(Options|array $options): self
    {
        $obj = clone $this;
        $obj['options'] = $options;

        return $obj;
    }
}
