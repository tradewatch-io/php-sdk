<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class LastQuote extends JsonSerializableType
{
    /**
     * @var string $symbol Symbol name
     */
    #[JsonProperty('symbol')]
    public string $symbol;

    /**
     * @var float $ask The ask price.
     */
    #[JsonProperty('ask')]
    public float $ask;

    /**
     * @var float $bid The bid price.
     */
    #[JsonProperty('bid')]
    public float $bid;

    /**
     * @var float $mid The mid price.
     */
    #[JsonProperty('mid')]
    public float $mid;

    /**
     * @var int $timestamp
     */
    #[JsonProperty('timestamp')]
    public int $timestamp;

    /**
     * @param array{
     *   symbol: string,
     *   ask: float,
     *   bid: float,
     *   mid: float,
     *   timestamp: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->symbol = $values['symbol'];
        $this->ask = $values['ask'];
        $this->bid = $values['bid'];
        $this->mid = $values['mid'];
        $this->timestamp = $values['timestamp'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
