<?php

declare(strict_types=1);

namespace ImageKit\Responses\Folders;

use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type folder_new_response_alias = array{}
 */
final class FolderNewResponse implements BaseModel
{
    use SdkModel;

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
    public static function with(): self
    {
        return new self;
    }
}
