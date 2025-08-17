<?php

declare(strict_types=1);

namespace ImageKit\Shared;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Shared\AutoDescriptionExtension\Name;

/**
 * @phpstan-type auto_description_extension_alias = array{name: Name::*}
 */
final class AutoDescriptionExtension implements BaseModel
{
    use Model;

    /**
     * Specifies the auto description extension.
     *
     * @var Name::* $name
     */
    #[Api(enum: Name::class)]
    public string $name;

    /**
     * `new AutoDescriptionExtension()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutoDescriptionExtension::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutoDescriptionExtension)->withName(...)
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
     * @param Name::* $name
     */
    public static function with(string $name): self
    {
        $obj = new self;

        $obj->name = $name;

        return $obj;
    }

    /**
     * Specifies the auto description extension.
     *
     * @param Name::* $name
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }
}
