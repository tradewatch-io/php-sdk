<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

/**
 * Usage history entry
 */
class ApiUsageEntry extends JsonSerializableType
{
    /**
     * @var int $requests
     */
    #[JsonProperty('requests')]
    public int $requests;

    /**
     * @var ApiUsageDataTransfer $data
     */
    #[JsonProperty('data')]
    public ApiUsageDataTransfer $data;

    /**
     * @param array{
     *   requests: int,
     *   data: ApiUsageDataTransfer,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->requests = $values['requests'];
        $this->data = $values['data'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
