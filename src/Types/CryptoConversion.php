<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class CryptoConversion extends JsonSerializableType
{
    /**
     * @var ConversionInfo $info
     */
    #[JsonProperty('info')]
    public ConversionInfo $info;

    /**
     * @var CryptoConversionQuery $query
     */
    #[JsonProperty('query')]
    public CryptoConversionQuery $query;

    /**
     * @var float $result
     */
    #[JsonProperty('result')]
    public float $result;

    /**
     * @param array{
     *   info: ConversionInfo,
     *   query: CryptoConversionQuery,
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
