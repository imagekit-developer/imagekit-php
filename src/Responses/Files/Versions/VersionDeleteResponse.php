<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Versions;

use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type version_delete_response_alias = array{}
 */
final class VersionDeleteResponse implements BaseModel
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
