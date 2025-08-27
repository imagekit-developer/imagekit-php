<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type file_move_response = array{}
 */
final class FileMoveResponse implements BaseModel
{
    /** @use SdkModel<file_move_response> */
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
