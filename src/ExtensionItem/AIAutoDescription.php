<?php

declare(strict_types=1);

namespace Imagekit\ExtensionItem;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AIAutoDescriptionShape = array{name?: 'ai-auto-description'}
 */
final class AIAutoDescription implements BaseModel
{
    /** @use SdkModel<AIAutoDescriptionShape> */
    use SdkModel;

    /**
     * Specifies the auto description extension.
     *
     * @var 'ai-auto-description' $name
     */
    #[Required]
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
