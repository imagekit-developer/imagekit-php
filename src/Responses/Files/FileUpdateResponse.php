<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Files\FileUpdateResponse\ExtensionStatus;

/**
 * Object containing details of a file or file version.
 */
final class FileUpdateResponse implements BaseModel
{
    use SdkModel;

    #[Api(optional: true)]
    public ?ExtensionStatus $extensionStatus;

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
    public static function with(?ExtensionStatus $extensionStatus = null): self
    {
        $obj = new self;

        null !== $extensionStatus && $obj->extensionStatus = $extensionStatus;

        return $obj;
    }

    public function withExtensionStatus(ExtensionStatus $extensionStatus): self
    {
        $obj = clone $this;
        $obj->extensionStatus = $extensionStatus;

        return $obj;
    }
}
