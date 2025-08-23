<?php

declare(strict_types=1);

namespace ImageKit\Files\FileUpdateParams\Update\UpdateFileDetails\Extension;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

final class AIAutoDescription implements BaseModel
{
    use SdkModel;

    /**
     * Specifies the auto description extension.
     */
    #[Api]
    public string $name = 'ai-auto-description';

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
