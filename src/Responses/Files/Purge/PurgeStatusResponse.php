<?php

declare(strict_types=1);

namespace ImageKit\Responses\Files\Purge;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Contracts\BaseModel;
use ImageKit\Responses\Files\Purge\PurgeStatusResponse\Status;

/**
 * @phpstan-type purge_status_response_alias = array{status?: Status::*}
 */
final class PurgeStatusResponse implements BaseModel
{
    use Model;

    /**
     * Status of the purge request.
     *
     * @var null|Status::* $status
     */
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

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
     * @param null|Status::* $status
     */
    public static function with(?string $status = null): self
    {
        $obj = new self;

        null !== $status && $obj->status = $status;

        return $obj;
    }

    /**
     * Status of the purge request.
     *
     * @param Status::* $status
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }
}
