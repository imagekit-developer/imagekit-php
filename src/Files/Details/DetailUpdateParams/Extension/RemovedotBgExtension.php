<?php

declare(strict_types=1);

namespace ImageKit\Files\Details\DetailUpdateParams\Extension;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Files\Details\DetailUpdateParams\Extension\RemovedotBgExtension\Name;
use ImageKit\Files\Details\DetailUpdateParams\Extension\RemovedotBgExtension\Options;

/**
 * @phpstan-type removedot_bg_extension_alias = array{
 *   name: Name::*, options?: Options
 * }
 */
final class RemovedotBgExtension implements BaseModel
{
    use Model;

    /**
     * Specifies the background removal extension.
     *
     * @var Name::* $name
     */
    #[Api(enum: Name::class)]
    public string $name;

    #[Api(optional: true)]
    public ?Options $options;

    /**
     * `new RemovedotBgExtension()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RemovedotBgExtension::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RemovedotBgExtension)->withName(...)
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
    public static function with(string $name, ?Options $options = null): self
    {
        $obj = new self;

        $obj->name = $name;

        null !== $options && $obj->options = $options;

        return $obj;
    }

    /**
     * Specifies the background removal extension.
     *
     * @param Name::* $name
     */
    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    public function withOptions(Options $options): self
    {
        $obj = clone $this;
        $obj->options = $options;

        return $obj;
    }
}
