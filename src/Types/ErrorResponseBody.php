<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class ErrorResponseBody extends JsonSerializableType
{
    /**
     * @var ErrorDetails $error
     */
    #[JsonProperty('error')]
    public ErrorDetails $error;

    /**
     * @param array{
     *   error: ErrorDetails,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->error = $values['error'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
