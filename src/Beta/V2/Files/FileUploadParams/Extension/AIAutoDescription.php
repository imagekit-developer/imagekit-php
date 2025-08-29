<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Extension;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type ai_auto_description = array{name: string}
 */
final class AIAutoDescription implements BaseModel
{
    /** @use SdkModel<ai_auto_description> */
    use SdkModel;

    /**
     * Specifies the auto description extension.
     */
    #[Api]
    public string $name = 'ai-auto-description';

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
