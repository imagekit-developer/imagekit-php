<?php

declare(strict_types=1);

namespace ImageKit\Accounts;

use ImageKit\Core\Attributes\Api;
use ImageKit\Core\Concerns\Model;
use ImageKit\Core\Concerns\Params;
use ImageKit\Core\Contracts\BaseModel;

/**
 * Get the account usage information between two dates. Note that the API response includes data from the start date while excluding data from the end date. In other words, the data covers the period starting from the specified start date up to, but not including, the end date.
 *
 * @phpstan-type get_usage_params = array{
 *   endDate: \DateTimeInterface, startDate: \DateTimeInterface
 * }
 */
final class AccountGetUsageParams implements BaseModel
{
    use Model;
    use Params;

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
    public static function from(
        \DateTimeInterface $endDate,
        \DateTimeInterface $startDate
    ): self {
        $obj = new self;

        $obj->endDate = $endDate;
        $obj->startDate = $startDate;

        return $obj;
    }

    /**
     * Specify a `endDate` in `YYYY-MM-DD` format. It should be after the `startDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Specify a `startDate` in `YYYY-MM-DD` format. It should be before the `endDate`. The difference between `startDate` and `endDate` should be less than 90 days.
     */
    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }
}
