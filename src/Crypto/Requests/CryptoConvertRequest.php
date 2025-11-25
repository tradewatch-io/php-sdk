<?php

namespace Tradewatch\Crypto\Requests;

use Tradewatch\Core\Json\JsonSerializableType;

class CryptoConvertRequest extends JsonSerializableType
{
    /**
     * @var ?float $amount The amount to be converted.
     */
    public ?float $amount;

    /**
     * @var ?int $precision The decimal precision of the result.
     */
    public ?int $precision;

    /**
     * @param array{
     *   amount?: ?float,
     *   precision?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->amount = $values['amount'] ?? null;
        $this->precision = $values['precision'] ?? null;
    }
}
