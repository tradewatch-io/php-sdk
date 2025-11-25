<?php

namespace Tradewatch\Stocks\Requests;

use Tradewatch\Core\Json\JsonSerializableType;

class StocksGetQuoteRequest extends JsonSerializableType
{
    /**
     * @var string $symbol The symbol to get the quote for.
     */
    public string $symbol;

    /**
     * @var ?int $precision The decimal precision of the result.
     */
    public ?int $precision;

    /**
     * @param array{
     *   symbol: string,
     *   precision?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->symbol = $values['symbol'];
        $this->precision = $values['precision'] ?? null;
    }
}
