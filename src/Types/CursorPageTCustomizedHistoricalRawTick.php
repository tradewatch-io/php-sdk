<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

class CursorPageTCustomizedHistoricalRawTick extends JsonSerializableType
{
    /**
     * @var array<HistoricalRawTick> $items
     */
    #[JsonProperty('items'), ArrayType([HistoricalRawTick::class])]
    public array $items;

    /**
     * @var ?int $total Total items
     */
    #[JsonProperty('total')]
    public ?int $total;

    /**
     * @var ?string $currentPage Cursor to refetch the current page
     */
    #[JsonProperty('current_page')]
    public ?string $currentPage;

    /**
     * @var ?string $currentPageBackwards Cursor to refetch the current page starting from the last item
     */
    #[JsonProperty('current_page_backwards')]
    public ?string $currentPageBackwards;

    /**
     * @var ?string $previousPage Cursor for the previous page
     */
    #[JsonProperty('previous_page')]
    public ?string $previousPage;

    /**
     * @var ?string $nextPage Cursor for the next page
     */
    #[JsonProperty('next_page')]
    public ?string $nextPage;

    /**
     * @param array{
     *   items: array<HistoricalRawTick>,
     *   total?: ?int,
     *   currentPage?: ?string,
     *   currentPageBackwards?: ?string,
     *   previousPage?: ?string,
     *   nextPage?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->items = $values['items'];
        $this->total = $values['total'] ?? null;
        $this->currentPage = $values['currentPage'] ?? null;
        $this->currentPageBackwards = $values['currentPageBackwards'] ?? null;
        $this->previousPage = $values['previousPage'] ?? null;
        $this->nextPage = $values['nextPage'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
