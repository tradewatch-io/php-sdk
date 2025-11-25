<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

class NewsOut extends JsonSerializableType
{
    /**
     * @var int $timestamp
     */
    #[JsonProperty('timestamp')]
    public int $timestamp;

    /**
     * @var string $content
     */
    #[JsonProperty('content')]
    public string $content;

    /**
     * @var NewsMetaData $metaData
     */
    #[JsonProperty('meta_data')]
    public NewsMetaData $metaData;

    /**
     * @param array{
     *   timestamp: int,
     *   content: string,
     *   metaData: NewsMetaData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->timestamp = $values['timestamp'];
        $this->content = $values['content'];
        $this->metaData = $values['metaData'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
