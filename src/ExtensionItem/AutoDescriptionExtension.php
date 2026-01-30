<?php

declare(strict_types=1);

namespace Imagekit\ExtensionItem;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutoDescriptionExtensionShape = array{name: 'ai-auto-description'}
 */
final class AutoDescriptionExtension implements BaseModel
{
    /** @use SdkModel<AutoDescriptionExtensionShape> */
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

    /**
     * Specifies the auto description extension.
     *
     * @param 'ai-auto-description' $name
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
