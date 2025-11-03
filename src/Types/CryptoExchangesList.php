<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

/**
 * A list of cryptocurrency exchanges
 */
class CryptoExchangesList extends JsonSerializableType
{
    /**
     * @var array<CryptoExchangeItem> $items
     */
    #[JsonProperty('items'), ArrayType([CryptoExchangeItem::class])]
    public array $items;

    /**
     * @param array{
     *   items: array<CryptoExchangeItem>,
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
