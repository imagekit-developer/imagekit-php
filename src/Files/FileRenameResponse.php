<?php

declare(strict_types=1);

namespace ImageKit\Files;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type FileRenameResponseShape = array{purgeRequestID?: string|null}
 */
final class FileRenameResponse implements BaseModel
{
    /** @use SdkModel<FileRenameResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    #[Optional('purgeRequestId')]
    public ?string $purgeRequestID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $purgeRequestID = null): self
    {
        $self = new self;

        null !== $purgeRequestID && $self['purgeRequestID'] = $purgeRequestID;

        return $self;
    }

    /**
     * Unique identifier of the purge request. This can be used to check the status of the purge request.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $self = clone $this;
        $self['purgeRequestID'] = $purgeRequestID;

        return $self;
    }
}
