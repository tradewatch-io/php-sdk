<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

class LastQuotes extends JsonSerializableType
{
    /**
     * @var array<LastQuote> $items
     */
    #[JsonProperty('items'), ArrayType([LastQuote::class])]
    public array $items;

    /**
     * @param array{
     *   items: array<LastQuote>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
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
