<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use DateTime;
use Tradewatch\Core\Types\Date;

class MarketStatusResponse extends JsonSerializableType
{
    /**
     * @var string $mic
     */
    #[JsonProperty('mic')]
    public string $mic;

    /**
     * @var string $dayOfWeek
     */
    #[JsonProperty('day_of_week')]
    public string $dayOfWeek;

    /**
     * @var bool $isWeekend
     */
    #[JsonProperty('is_weekend')]
    public bool $isWeekend;

    /**
     * @var bool $isBusinessDay
     */
    #[JsonProperty('is_business_day')]
    public bool $isBusinessDay;

    /**
     * @var value-of<Status> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?bool $isEarlyClose
     */
    #[JsonProperty('is_early_close')]
    public ?bool $isEarlyClose;

    /**
     * @var DateTime $localTime
     */
    #[JsonProperty('local_time'), Date(Date::TYPE_DATETIME)]
    public DateTime $localTime;

    /**
     * @var ?DateTime $openTime
     */
    #[JsonProperty('open_time'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $openTime;

    /**
     * @var ?DateTime $closeTime
     */
    #[JsonProperty('close_time'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $closeTime;

    /**
     * @var ?string $holidayName
     */
    #[JsonProperty('holiday_name')]
    public ?string $holidayName;

    /**
     * @param array{
     *   mic: string,
     *   dayOfWeek: string,
     *   isWeekend: bool,
     *   isBusinessDay: bool,
     *   status: value-of<Status>,
     *   localTime: DateTime,
     *   isEarlyClose?: ?bool,
     *   openTime?: ?DateTime,
     *   closeTime?: ?DateTime,
     *   holidayName?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mic = $values['mic'];
        $this->dayOfWeek = $values['dayOfWeek'];
        $this->isWeekend = $values['isWeekend'];
        $this->isBusinessDay = $values['isBusinessDay'];
        $this->status = $values['status'];
        $this->isEarlyClose = $values['isEarlyClose'] ?? null;
        $this->localTime = $values['localTime'];
        $this->openTime = $values['openTime'] ?? null;
        $this->closeTime = $values['closeTime'] ?? null;
        $this->holidayName = $values['holidayName'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
