<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class ErrorDetails extends JsonSerializableType
{
    /**
     * @var int $code
     */
    #[JsonProperty('code')]
    public int $code;

    /**
     * @var string $message
     */
    #[JsonProperty('message')]
    public string $message;

    /**
     * @param array{
     *   code: int,
     *   message: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->message = $values['message'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
