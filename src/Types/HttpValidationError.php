<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

class HttpValidationError extends JsonSerializableType
{
    /**
     * @var ?array<ValidationError> $detail
     */
    #[JsonProperty('detail'), ArrayType([ValidationError::class])]
    public ?array $detail;

    /**
     * @param array{
     *   detail?: ?array<ValidationError>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->detail = $values['detail'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
