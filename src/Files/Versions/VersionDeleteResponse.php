<?php

declare(strict_types=1);

namespace ImageKit\Files\Versions;

use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type version_delete_response = array{}
 */
final class VersionDeleteResponse implements BaseModel
{
    /** @use SdkModel<version_delete_response> */
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
