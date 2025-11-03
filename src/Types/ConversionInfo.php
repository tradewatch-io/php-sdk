<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class ConversionInfo extends JsonSerializableType
{
    /**
     * @var int $timestamp
     */
    #[JsonProperty('timestamp')]
    public int $timestamp;

    /**
     * @var float $rate
     */
    #[JsonProperty('rate')]
    public float $rate;

    /**
     * @param array{
     *   timestamp: int,
     *   rate: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->timestamp = $values['timestamp'];
        $this->rate = $values['rate'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
