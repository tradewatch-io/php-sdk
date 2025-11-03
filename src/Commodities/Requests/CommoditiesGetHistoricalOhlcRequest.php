<?php

namespace Tradewatch\Commodities\Requests;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Types\HistoricalDataResolution;

class CommoditiesGetHistoricalOhlcRequest extends JsonSerializableType
{
    /**
     * @var value-of<HistoricalDataResolution> $resolution Resolution in seconds.
     */
    public string $resolution;

    /**
     * @var int $start Unix timestamp (inclusive).
     */
    public int $start;

    /**
     * @var int $end Unix timestamp (exclusive).
     */
    public int $end;

    /**
     * @param array{
     *   resolution: value-of<HistoricalDataResolution>,
     *   start: int,
     *   end: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->resolution = $values['resolution'];
        $this->start = $values['start'];
        $this->end = $values['end'];
    }
}
