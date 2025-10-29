<?php

declare(strict_types=1);

namespace ImageKit\ExtensionItem;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\ExtensionItem\RemoveBg\Options;

/**
 * @phpstan-type RemoveBgShape = array{name: string, options?: Options}
 */
final class RemoveBg implements BaseModel
{
    /** @use SdkModel<RemoveBgShape> */
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
        $this->initialize();
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
