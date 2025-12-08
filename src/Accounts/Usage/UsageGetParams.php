<?php

declare(strict_types=1);

namespace Imagekit\Accounts\Usage;

use Imagekit\Core\Attributes\Api;
use Imagekit\Core\Concerns\SdkModel;
use Imagekit\Core\Concerns\SdkParams;
use Imagekit\Core\Contracts\BaseModel;

/**
 * Get the account usage information between two dates. Note that the API response includes data from the start date while excluding data from the end date. In other words, the data covers the period starting from the specified start date up to, but not including, the end date.
 *
 * @see Imagekit\Services\Accounts\UsageService::get()
 *
 * @phpstan-type UsageGetParamsShape = array{
 *   endDate: \DateTimeInterface, startDate: \DateTimeInterface
 * }
 */
final class UsageGetParams implements BaseModel
{
    /** @use SdkModel<UsageGetParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    #[Api]
    public \DateTimeInterface $endDate;

    /**
     * Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    #[Api]
    public \DateTimeInterface $startDate;

    /**
     * `new UsageGetParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UsageGetParams::with(endDate: ..., startDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UsageGetParams)->withEndDate(...)->withStartDate(...)
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
    public static function with(
        \DateTimeInterface $endDate,
        \DateTimeInterface $startDate
    ): self {
        $obj = new self;

        $obj['endDate'] = $endDate;
        $obj['startDate'] = $startDate;

        return $obj;
    }

    /**
     * Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function withEndDate(\DateTimeInterface $endDate): self
    {
        $obj = clone $this;
        $obj['endDate'] = $endDate;

        return $obj;
    }

    /**
     * Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function withStartDate(\DateTimeInterface $startDate): self
    {
        $obj = clone $this;
        $obj['startDate'] = $startDate;

        return $obj;
    }
}
