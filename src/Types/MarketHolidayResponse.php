<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use DateTime;
use Tradewatch\Core\Types\Date;

class MarketHolidayResponse extends JsonSerializableType
{
    /**
     * @var string $exchange Full name of the exchange
     */
    #[JsonProperty('exchange')]
    public string $exchange;

    /**
     * @var string $flag Country flag emoji
     */
    #[JsonProperty('flag')]
    public string $flag;

    /**
     * @var string $mic Market Identifier Code (ISO 10383)
     */
    #[JsonProperty('mic')]
    public string $mic;

    /**
     * @var string $date Date of the holiday (YYYY-MM-DD)
     */
    #[JsonProperty('date')]
    public string $date;

    /**
     * @var string $dayOfWeek Day of the week
     */
    #[JsonProperty('day_of_week')]
    public string $dayOfWeek;

    /**
     * @var bool $isWeekend Whether the holiday falls on a weekend
     */
    #[JsonProperty('is_weekend')]
    public bool $isWeekend;

    /**
     * @var bool $isBusinessDay Whether the day is a business day
     */
    #[JsonProperty('is_business_day')]
    public bool $isBusinessDay;

    /**
     * @var ?string $holidayName Name of the holiday
     */
    #[JsonProperty('holiday_name')]
    public ?string $holidayName;

    /**
     * @var ?bool $isEarlyClose Whether the market closes early on this day
     */
    #[JsonProperty('is_early_close')]
    public ?bool $isEarlyClose;

    /**
     * @var ?DateTime $openTime Opening time for the day
     */
    #[JsonProperty('open_time'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $openTime;

    /**
     * @var ?DateTime $closeTime Closing time for the day
     */
    #[JsonProperty('close_time'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $closeTime;

    /**
     * @param array{
     *   exchange: string,
     *   flag: string,
     *   mic: string,
     *   date: string,
     *   dayOfWeek: string,
     *   isWeekend: bool,
     *   isBusinessDay: bool,
     *   holidayName?: ?string,
     *   isEarlyClose?: ?bool,
     *   openTime?: ?DateTime,
     *   closeTime?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->exchange = $values['exchange'];
        $this->flag = $values['flag'];
        $this->mic = $values['mic'];
        $this->date = $values['date'];
        $this->dayOfWeek = $values['dayOfWeek'];
        $this->isWeekend = $values['isWeekend'];
        $this->isBusinessDay = $values['isBusinessDay'];
        $this->holidayName = $values['holidayName'] ?? null;
        $this->isEarlyClose = $values['isEarlyClose'] ?? null;
        $this->openTime = $values['openTime'] ?? null;
        $this->closeTime = $values['closeTime'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
