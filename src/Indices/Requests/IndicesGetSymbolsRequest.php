<?php

namespace Tradewatch\Indices\Requests;

use Tradewatch\Core\Json\JsonSerializableType;

class IndicesGetSymbolsRequest extends JsonSerializableType
{
    /**
     * @var ?int $size The number of items per page.
     */
    public ?int $size;

    /**
     * @var ?string $mode The mode of the response.
     */
    public ?string $mode;

    /**
     * @var ?string $type Type of the instrument.
     */
    public ?string $type;

    /**
     * @var ?string $country Country of the instrument.
     */
    public ?string $country;

    /**
     * @var ?string $cursor Cursor for the next page
     */
    public ?string $cursor;

    /**
     * @param array{
     *   size?: ?int,
     *   mode?: ?string,
     *   type?: ?string,
     *   country?: ?string,
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->size = $values['size'] ?? null;
        $this->mode = $values['mode'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
    }
}
