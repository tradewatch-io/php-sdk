<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use DateTime;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\Date;

class HistoricalRawTick extends JsonSerializableType
{
    /**
     * @var DateTime $time
     */
    #[JsonProperty('time'), Date(Date::TYPE_DATETIME)]
    public DateTime $time;

    /**
     * @var float $ask
     */
    #[JsonProperty('ask')]
    public float $ask;

    /**
     * @var float $bid
     */
    #[JsonProperty('bid')]
    public float $bid;

    /**
     * @var float $mid
     */
    #[JsonProperty('mid')]
    public float $mid;

    /**
     * @param array{
     *   time: DateTime,
     *   ask: float,
     *   bid: float,
     *   mid: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->time = $values['time'];
        $this->ask = $values['ask'];
        $this->bid = $values['bid'];
        $this->mid = $values['mid'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
