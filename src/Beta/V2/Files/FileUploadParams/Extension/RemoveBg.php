<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Extension;

use ImageKit\Beta\V2\Files\FileUploadParams\Extension\RemoveBg\Options;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type remove_bg = array{name: string, options?: Options|null}
 */
final class RemoveBg implements BaseModel
{
    /** @use SdkModel<remove_bg> */
    use SdkModel;

    /**
     * Specifies the background removal extension.
     */
    #[Api]
    public string $name = 'remove-bg';

    #[Api(optional: true)]
    public ?Options $options;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?Options $options = null): self
    {
        $obj = new self;

        null !== $options && $obj->options = $options;

        return $obj;
    }

    public function withOptions(Options $options): self
    {
        $obj = clone $this;
        $obj->options = $options;

        return $obj;
    }
}
