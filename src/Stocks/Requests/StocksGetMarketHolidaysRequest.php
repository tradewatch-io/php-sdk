<?php

namespace Tradewatch\Stocks\Requests;

use Tradewatch\Core\Json\JsonSerializableType;
use DateTime;

class StocksGetMarketHolidaysRequest extends JsonSerializableType
{
    /**
     * @var ?string $mic Specify comma separated list of MIC codes for which market to show data for.
     */
    public ?string $mic;

    /**
     * @var DateTime $start Show holidays starting at this date.
     */
    public DateTime $start;

    /**
     * @var DateTime $end Show holidays until this date.
     */
    public DateTime $end;

    /**
     * @param array{
     *   start: DateTime,
     *   end: DateTime,
     *   mic?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mic = $values['mic'] ?? null;
        $this->start = $values['start'];
        $this->end = $values['end'];
    }
}
