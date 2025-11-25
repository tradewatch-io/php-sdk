<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class HistoricalOhlcCandle extends JsonSerializableType
{
    /**
     * @var int $time
     */
    #[JsonProperty('time')]
    public int $time;

    /**
     * @var float $openAsk
     */
    #[JsonProperty('open_ask')]
    public float $openAsk;

    /**
     * @var float $highAsk
     */
    #[JsonProperty('high_ask')]
    public float $highAsk;

    /**
     * @var float $lowAsk
     */
    #[JsonProperty('low_ask')]
    public float $lowAsk;

    /**
     * @var float $closeAsk
     */
    #[JsonProperty('close_ask')]
    public float $closeAsk;

    /**
     * @var float $openBid
     */
    #[JsonProperty('open_bid')]
    public float $openBid;

    /**
     * @var float $highBid
     */
    #[JsonProperty('high_bid')]
    public float $highBid;

    /**
     * @var float $lowBid
     */
    #[JsonProperty('low_bid')]
    public float $lowBid;

    /**
     * @var float $closeBid
     */
    #[JsonProperty('close_bid')]
    public float $closeBid;

    /**
     * @param array{
     *   time: int,
     *   openAsk: float,
     *   highAsk: float,
     *   lowAsk: float,
     *   closeAsk: float,
     *   openBid: float,
     *   highBid: float,
     *   lowBid: float,
     *   closeBid: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->time = $values['time'];
        $this->openAsk = $values['openAsk'];
        $this->highAsk = $values['highAsk'];
        $this->lowAsk = $values['lowAsk'];
        $this->closeAsk = $values['closeAsk'];
        $this->openBid = $values['openBid'];
        $this->highBid = $values['highBid'];
        $this->lowBid = $values['lowBid'];
        $this->closeBid = $values['closeBid'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
