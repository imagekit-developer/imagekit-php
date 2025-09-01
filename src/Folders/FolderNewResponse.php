<?php

declare(strict_types=1);

namespace ImageKit\Folders;

use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type folder_new_response = array{}
 */
final class FolderNewResponse implements BaseModel
{
    /** @use SdkModel<folder_new_response> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
