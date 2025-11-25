<?php

namespace Tradewatch;

use Tradewatch\Account\AccountClient;
use Tradewatch\Currencies\CurrenciesClient;
use Tradewatch\Crypto\CryptoClient;
use Tradewatch\Indices\IndicesClient;
use Tradewatch\Stocks\StocksClient;
use Tradewatch\Commodities\CommoditiesClient;
use Psr\Http\Client\ClientInterface;
use Tradewatch\Core\Client\RawClient;

class TradewatchClient
{
    /**
     * @var AccountClient $account
     */
    public AccountClient $account;

    /**
     * @var CurrenciesClient $currencies
     */
    public CurrenciesClient $currencies;

    /**
     * @var CryptoClient $crypto
     */
    public CryptoClient $crypto;

    /**
     * @var IndicesClient $indices
     */
    public IndicesClient $indices;

    /**
     * @var StocksClient $stocks
     */
    public StocksClient $stocks;

    /**
     * @var CommoditiesClient $commodities
     */
    public CommoditiesClient $commodities;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param string $apiKey The apiKey to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        string $apiKey,
        ?array $options = null,
    ) {
        $defaultHeaders = [
            'api-key' => $apiKey,
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'Tradewatch',
        ];

        $this->options = $options ?? [];

        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->account = new AccountClient($this->client, $this->options);
        $this->currencies = new CurrenciesClient($this->client, $this->options);
        $this->crypto = new CryptoClient($this->client, $this->options);
        $this->indices = new IndicesClient($this->client, $this->options);
        $this->stocks = new StocksClient($this->client, $this->options);
        $this->commodities = new CommoditiesClient($this->client, $this->options);
    }
}
