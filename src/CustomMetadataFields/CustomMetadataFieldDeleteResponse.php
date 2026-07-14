<?php

declare(strict_types=1);

namespace ImageKit\CustomMetadataFields;

use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type CustomMetadataFieldDeleteResponseShape = array<string,mixed>
 */
final class CustomMetadataFieldDeleteResponse implements BaseModel
{
    /** @use SdkModel<CustomMetadataFieldDeleteResponseShape> */
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
