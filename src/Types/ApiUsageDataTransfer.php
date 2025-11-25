<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

/**
 * Data transfer
 */
class ApiUsageDataTransfer extends JsonSerializableType
{
    /**
     * @var int $request
     */
    #[JsonProperty('request')]
    public int $request;

    /**
     * @var int $response
     */
    #[JsonProperty('response')]
    public int $response;

    /**
     * @param array{
     *   request: int,
     *   response: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->request = $values['request'];
        $this->response = $values['response'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
