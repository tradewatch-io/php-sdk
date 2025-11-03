<?php

namespace Tradewatch\Currencies\Requests;

use Tradewatch\Core\Json\JsonSerializableType;

class CurrenciesGetQuotesRequest extends JsonSerializableType
{
    /**
     * @var string $symbols Comma separated list of symbols.
     */
    public string $symbols;

    /**
     * @var ?int $precision The decimal precision of the result.
     */
    public ?int $precision;

    /**
     * @param array{
     *   symbols: string,
     *   precision?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->symbols = $values['symbols'];
        $this->precision = $values['precision'] ?? null;
    }
}
