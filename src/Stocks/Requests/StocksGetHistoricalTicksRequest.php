<?php

namespace Tradewatch\Stocks\Requests;

use Tradewatch\Core\Json\JsonSerializableType;

class StocksGetHistoricalTicksRequest extends JsonSerializableType
{
    /**
     * @var int $start Unix timestamp (inclusive).
     */
    public int $start;

    /**
     * @var int $end Unix timestamp (exclusive).
     */
    public int $end;

    /**
     * @var ?string $cursor Cursor for the next page
     */
    public ?string $cursor;

    /**
     * @var ?int $limit The number of ticks per page.
     */
    public ?int $limit;

    /**
     * @param array{
     *   start: int,
     *   end: int,
     *   cursor?: ?string,
     *   limit?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->start = $values['start'];
        $this->end = $values['end'];
        $this->cursor = $values['cursor'] ?? null;
        $this->limit = $values['limit'] ?? null;
    }
}
