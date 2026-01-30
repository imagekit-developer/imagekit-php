<?php

declare(strict_types=1);

namespace Imagekit\ExtensionItem;

use Imagekit\Core\Attributes\Optional;
use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;
use Imagekit\ExtensionItem\RemovedotBgExtension\Options;

/**
 * @phpstan-import-type OptionsShape from \Imagekit\ExtensionItem\RemovedotBgExtension\Options
 *
 * @phpstan-type RemovedotBgExtensionShape = array{
 *   name: 'remove-bg', options?: null|Options|OptionsShape
 * }
 */
final class RemovedotBgExtension implements BaseModel
{
    /** @use SdkModel<RemovedotBgExtensionShape> */
    use SdkModel;

    /**
     * Specifies the background removal extension.
     *
     * @var 'remove-bg' $name
     */
    #[Required]
    public string $name = 'remove-bg';

    #[Optional]
    public ?Options $options;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Options|OptionsShape|null $options
     */
    public static function with(Options|array|null $options = null): self
    {
        $self = new self;

        null !== $options && $self['options'] = $options;

        return $self;
    }

    /**
     * Specifies the background removal extension.
     *
     * @param 'remove-bg' $name
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * @param Options|OptionsShape $options
     */
    public function withOptions(Options|array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }
}
