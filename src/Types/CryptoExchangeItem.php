<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;

/**
 * A cryptocurrency exchange
 */
class CryptoExchangeItem extends JsonSerializableType
{
    /**
     * @var string $id Exchange identifier (e.g. binance, coinbase-pro).
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var string $name Exchange name (e.g. Binance, Coinbase Pro).
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?int $yearEstablished The year the exchange was established
     */
    #[JsonProperty('year_established')]
    public ?int $yearEstablished;

    /**
     * @var ?string $country The country where the exchange is based.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var string $website The exchange's official website URL.
     */
    #[JsonProperty('website')]
    public string $website;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   website: string,
     *   yearEstablished?: ?int,
     *   country?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->yearEstablished = $values['yearEstablished'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->website = $values['website'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
