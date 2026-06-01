<?php

declare(strict_types=1);

namespace ImageKit\SavedExtensions;

use ImageKit\Core\Attributes\Required;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * This API creates a new saved extension. Saved extensions allow you to save complex extension configurations (like AI tasks) and reuse them by referencing the ID in upload or update file APIs.
 *
 * **Saved extension limit** \
 * You can create a maximum of 100 saved extensions per account.
 *
 * @see ImageKit\Services\SavedExtensionsService::create()
 *
 * @phpstan-import-type CreateSavedExtensionShape from \ImageKit\SavedExtensions\CreateSavedExtension
 *
 * @phpstan-type SavedExtensionCreateParamsShape = array{
 *   createSavedExtension: CreateSavedExtension|CreateSavedExtensionShape
 * }
 */
final class SavedExtensionCreateParams implements BaseModel
{
    /** @use SdkModel<SavedExtensionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public CreateSavedExtension $createSavedExtension;

    /**
     * `new SavedExtensionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SavedExtensionCreateParams::with(createSavedExtension: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SavedExtensionCreateParams)->withCreateSavedExtension(...)
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
     *
     * @param CreateSavedExtension|CreateSavedExtensionShape $createSavedExtension
     */
    public static function with(
        CreateSavedExtension|array $createSavedExtension
    ): self {
        $self = new self;

        $self['createSavedExtension'] = $createSavedExtension;

        return $self;
    }

    /**
     * @param CreateSavedExtension|CreateSavedExtensionShape $createSavedExtension
     */
    public function withCreateSavedExtension(
        CreateSavedExtension|array $createSavedExtension
    ): self {
        $self = clone $this;
        $self['createSavedExtension'] = $createSavedExtension;

        return $self;
    }
}
