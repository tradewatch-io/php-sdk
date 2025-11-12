<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class SymbolsOutFullStocks extends JsonSerializableType
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
     * @var string $country The country where the stock is listed.
     */
    #[JsonProperty('country')]
    public string $country;

    /**
     * @var string $description The stock description.
     */
    #[JsonProperty('description')]
    public string $description;

    /**
     * @param array{
     *   symbol: string,
     *   name: string,
     *   country: string,
     *   description: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->symbol = $values['symbol'];
        $this->name = $values['name'];
        $this->country = $values['country'];
        $this->description = $values['description'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
