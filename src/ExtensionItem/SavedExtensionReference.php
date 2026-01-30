<?php

declare(strict_types=1);

namespace Imagekit\ExtensionItem;

use Imagekit\Core\Attributes\Required;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Contracts\BaseModel;

/**
 * @phpstan-type SavedExtensionReferenceShape = array{
 *   id: string, name: 'saved-extension'
 * }
 */
final class SavedExtensionReference implements BaseModel
{
    /** @use SdkModel<SavedExtensionReferenceShape> */
    use SdkModel;

    /**
     * Indicates this is a reference to a saved extension.
     *
     * @var 'saved-extension' $name
     */
    #[Required]
    public string $name = 'saved-extension';

    /**
     * The unique ID of the saved extension to apply.
     */
    #[Required]
    public string $id;

    /**
     * `new SavedExtensionReference()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SavedExtensionReference::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SavedExtensionReference)->withID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    /**
     * The unique ID of the saved extension to apply.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Indicates this is a reference to a saved extension.
     *
     * @param 'saved-extension' $name
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
