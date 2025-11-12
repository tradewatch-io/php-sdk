<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

class HistoricalOhlcResponse extends JsonSerializableType
{
    /**
     * @var string $symbol
     */
    #[JsonProperty('symbol')]
    public string $symbol;

    /**
     * @var string $resolution
     */
    #[JsonProperty('resolution')]
    public string $resolution;

    /**
     * @var array<HistoricalOhlcCandle> $items
     */
    #[JsonProperty('items'), ArrayType([HistoricalOhlcCandle::class])]
    public array $items;

    /**
     * @param array{
     *   symbol: string,
     *   resolution: string,
     *   items: array<HistoricalOhlcCandle>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->symbol = $values['symbol'];
        $this->resolution = $values['resolution'];
        $this->items = $values['items'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
