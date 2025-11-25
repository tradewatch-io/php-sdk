<?php

namespace Tradewatch\Stocks\Requests;

use Tradewatch\Core\Json\JsonSerializableType;
use DateTime;

class StocksGetTradingHoursRequest extends JsonSerializableType
{
    /**
     * @var ?string $mic Optional list of comma separated MIC codes for which market to show data for. All market will be included if MIC code is not specified.
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
