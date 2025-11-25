<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class StockDataFlatResponse extends JsonSerializableType
{
    /**
     * @var ?string $symbol
     */
    #[JsonProperty('symbol')]
    public ?string $symbol;

    /**
     * @param array{
     *   symbol?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->symbol = $values['symbol'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
