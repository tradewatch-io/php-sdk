<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

/**
 * A list of commodity types
 */
class CommodityTypesList extends JsonSerializableType
{
    /**
     * @var array<CommodityTypeObj> $items
     */
    #[JsonProperty('items'), ArrayType([CommodityTypeObj::class])]
    public array $items;

    /**
     * @param array{
     *   items: array<CommodityTypeObj>,
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
