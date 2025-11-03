<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use Tradewatch\Core\Types\ArrayType;

class NewsMetaData extends JsonSerializableType
{
    /**
     * @var ?array<string> $markets
     */
    #[JsonProperty('markets'), ArrayType(['string'])]
    public ?array $markets;

    /**
     * @var ?array<string> $tickets
     */
    #[JsonProperty('tickets'), ArrayType(['string'])]
    public ?array $tickets;

    /**
     * @var ?array<string> $hashtags
     */
    #[JsonProperty('hashtags'), ArrayType(['string'])]
    public ?array $hashtags;

    /**
     * @param array{
     *   markets?: ?array<string>,
     *   tickets?: ?array<string>,
     *   hashtags?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->markets = $values['markets'] ?? null;
        $this->tickets = $values['tickets'] ?? null;
        $this->hashtags = $values['hashtags'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
