<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use DateTime;
use Tradewatch\Core\Types\Date;

class TradingHoursResponse extends JsonSerializableType
{
    /**
     * @var string $mic Market Identifier Code (ISO 10383)
     */
    #[JsonProperty('mic')]
    public string $mic;

    /**
     * @var string $date Date of the trading session (YYYY-MM-DD)
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var string $dayOfWeek Day of the week
     */
    #[JsonProperty('day_of_week')]
    public string $dayOfWeek;

    /**
     * @var bool $isEarlyClose Whether the market closes early on this day
     */
    #[JsonProperty('is_early_close')]
    public bool $isEarlyClose;

    /**
     * @var DateTime $openTime Opening time for the day
     */
    #[JsonProperty('open_time'), Date(Date::TYPE_DATETIME)]
    public DateTime $openTime;

    /**
     * @var DateTime $closeTime Closing time for the day
     */
    #[JsonProperty('close_time'), Date(Date::TYPE_DATETIME)]
    public DateTime $closeTime;

    /**
     * @var ?string $holidayName Name of the holiday if applicable
     */
    #[JsonProperty('holiday_name')]
    public ?string $holidayName;

    /**
     * @param array{
     *   mic: string,
     *   date: string,
     *   dayOfWeek: string,
     *   isEarlyClose: bool,
     *   openTime: DateTime,
     *   closeTime: DateTime,
     *   holidayName?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mic = $values['mic'];
        $this->date = $values['date'];
        $this->dayOfWeek = $values['dayOfWeek'];
        $this->isEarlyClose = $values['isEarlyClose'];
        $this->openTime = $values['openTime'];
        $this->closeTime = $values['closeTime'];
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
