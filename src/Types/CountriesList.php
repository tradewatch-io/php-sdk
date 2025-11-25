<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

/**
 * A list of Countries
 */
class CountriesList extends JsonSerializableType
{
    /**
     * @var array<CountryObj> $items
     */
    #[JsonProperty('items'), ArrayType([CountryObj::class])]
    public array $items;

    /**
     * @param array{
     *   items: array<CountryObj>,
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
