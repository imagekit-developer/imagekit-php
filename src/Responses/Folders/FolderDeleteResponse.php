<?php

declare(strict_types=1);

namespace ImageKit\Responses\Folders;

use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type folder_delete_response_alias = array{}
 */
final class FolderDeleteResponse implements BaseModel
{
    use Model;

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
