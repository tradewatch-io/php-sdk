<?php

namespace Tradewatch\Stocks\Requests;

use Tradewatch\Core\Json\JsonSerializableType;

class StocksGetMarketStatusRequest extends JsonSerializableType
{
    /**
     * @var ?string $mic Optional list of comma separated MIC codes for which market to show data for. All market will be included if MIC code is not specified.
     */
    public ?string $mic;

    /**
     * @param array{
     *   mic?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mic = $values['mic'] ?? null;
    }
}
