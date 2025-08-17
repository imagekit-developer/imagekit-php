<?php

declare(strict_types=1);

namespace ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post;

use ImageKit\Beta\V2\Files\FileUploadParams\Transformation\Post\GenerateAThumbnail\Type;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type generate_a_thumbnail_alias = array{type: Type::*, value?: string}
 */
final class GenerateAThumbnail implements BaseModel
{
    use Model;

    /**
     * Generates a thumbnail image.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Optional transformation string.
     * **Example**: `w-150,h-150`.
     */
    #[Api(optional: true)]
    public ?string $value;

    /**
     * `new GenerateAThumbnail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GenerateAThumbnail::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GenerateAThumbnail)->withType(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type::* $type
     */
    public static function with(string $type, ?string $value = null): self
    {
        $obj = new self;

        $obj->type = $type;

        null !== $value && $obj->value = $value;

        return $obj;
    }

    /**
     * Generates a thumbnail image.
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Optional transformation string.
     * **Example**: `w-150,h-150`.
     */
    public function withValue(string $value): self
    {
        $obj = clone $this;
        $obj->value = $value;

        return $obj;
    }
}
