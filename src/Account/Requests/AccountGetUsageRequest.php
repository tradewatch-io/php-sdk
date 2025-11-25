<?php

namespace Tradewatch\Account\Requests;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Types\AccountUsageStatisticsInterval;

class AccountGetUsageRequest extends JsonSerializableType
{
    /**
     * @var ?int $limit The number of data points to return (max 168).
     */
    public ?int $limit;

    /**
     * @var ?value-of<AccountUsageStatisticsInterval> $interval The time interval for the usage statistics.
     */
    public ?string $interval;

    /**
     * @param array{
     *   limit?: ?int,
     *   interval?: ?value-of<AccountUsageStatisticsInterval>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->limit = $values['limit'] ?? null;
        $this->interval = $values['interval'] ?? null;
    }
}
