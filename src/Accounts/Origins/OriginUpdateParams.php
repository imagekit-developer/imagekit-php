<?php

declare(strict_types=1);

namespace ImageKit\Accounts\Origins;

use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AkeneoPim;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\AzureBlobStorage;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\CloudinaryBackup;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\GoogleCloudStorageGcs;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\S3Compatible;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebFolder;
use ImageKit\Accounts\Origins\OriginUpdateParams\Origin\WebProxy;
use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\SdkModel;
use ImageKit\Core\Concerns\SdkParams;
use ImageKit\Core\Contracts\BaseModel;

/**
 * **Note:** This API is currently in beta.
 * Updates the origin identified by `id` and returns the updated origin object.
 *
 * @phpstan-type update_params = array{
 *   origin: S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim,
 * }
 */
final class OriginUpdateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    /**
     * Schema for origin resources.
     */
    #[Api]
    public S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim $origin;

    /**
     * `new OriginUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OriginUpdateParams::with(origin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OriginUpdateParams)->withOrigin(...)
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
     */
    public static function with(
        S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim $origin,
    ): self {
        $obj = new self;

        $obj->origin = $origin;

        return $obj;
    }

    /**
     * Schema for origin resources.
     */
    public function withOrigin(
        S3|S3Compatible|CloudinaryBackup|WebFolder|WebProxy|GoogleCloudStorageGcs|AzureBlobStorage|AkeneoPim $origin,
    ): self {
        $obj = clone $this;
        $obj->origin = $origin;

        return $obj;
    }
}
