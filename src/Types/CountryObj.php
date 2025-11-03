<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class CountryObj extends JsonSerializableType
{
    /**
     * @var string $symbol Country symbol
     */
    #[JsonProperty('symbol')]
    public string $symbol;

    /**
     * @param array{
     *   symbol: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->symbol = $values['symbol'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
