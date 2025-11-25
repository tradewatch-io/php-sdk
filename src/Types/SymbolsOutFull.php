<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class SymbolsOutFull extends JsonSerializableType
{
    /**
     * @var string $symbol The unique symbol of the financial instrument (e.g. AAPL, BTCUSD, etc.).
     */
    #[JsonProperty('symbol')]
    public string $symbol;

    /**
     * @var string $name The full name of the financial instrument.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @param array{
     *   symbol: string,
     *   name: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->symbol = $values['symbol'];
        $this->name = $values['name'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
