<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class ConversionQuery extends JsonSerializableType
{
    /**
     * @var string $from The symbol you want to convert from.
     */
    #[JsonProperty('from')]
    public string $from;

    /**
     * @var string $to The symbol you want to convert to.
     */
    #[JsonProperty('to')]
    public string $to;

    /**
     * @var ?float $amount The amount to be converted.
     */
    #[JsonProperty('amount')]
    public ?float $amount;

    /**
     * @var ?int $precision The decimal precision of the result.
     */
    #[JsonProperty('precision')]
    public ?int $precision;

    /**
     * @param array{
     *   from: string,
     *   to: string,
     *   amount?: ?float,
     *   precision?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->from = $values['from'];
        $this->to = $values['to'];
        $this->amount = $values['amount'] ?? null;
        $this->precision = $values['precision'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
