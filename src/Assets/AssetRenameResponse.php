<?php

declare(strict_types=1);

namespace ImageKit\Assets;

use ImageKit\Core\Attributes\Optional;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetRenameResponseShape = array{purgeRequestID?: string|null}
 */
final class AssetRenameResponse implements BaseModel
{
    /** @use SdkModel<AssetRenameResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the purge request. Use it with the purge status API to check the purge progress.
     */
    #[Optional('purge_request_id')]
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
     * Unique identifier of the purge request. Use it with the purge status API to check the purge progress.
     */
    public function withPurgeRequestID(string $purgeRequestID): self
    {
        $self = clone $this;
        $self['purgeRequestID'] = $purgeRequestID;

        return $self;
    }
}
