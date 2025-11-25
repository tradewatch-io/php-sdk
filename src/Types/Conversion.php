<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class Conversion extends JsonSerializableType
{
    /**
     * @var ConversionInfo $info
     */
    #[JsonProperty('info')]
    public ConversionInfo $info;

    /**
     * @var ConversionQuery $query
     */
    #[JsonProperty('query')]
    public ConversionQuery $query;

    /**
     * @var float $result
     */
    #[JsonProperty('result')]
    public float $result;

    /**
     * @param array{
     *   info: ConversionInfo,
     *   query: ConversionQuery,
     *   result: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->info = $values['info'];
        $this->query = $values['query'];
        $this->result = $values['result'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
