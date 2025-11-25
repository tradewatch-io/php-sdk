<?php

namespace Tradewatch\Crypto\Requests;

use Tradewatch\Core\Json\JsonSerializableType;

class CryptoGetInsightsRequest extends JsonSerializableType
{
    /**
     * @var ?string $cursor Cursor for the next page
     */
    public ?string $cursor;

    /**
     * @var ?int $size The number of items per page.
     */
    public ?int $size;

    /**
     * @param array{
     *   cursor?: ?string,
     *   size?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cursor = $values['cursor'] ?? null;
        $this->size = $values['size'] ?? null;
    }
}
