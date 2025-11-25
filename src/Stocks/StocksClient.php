<?php

namespace Tradewatch\Stocks;

use Psr\Http\Client\ClientInterface;
use Tradewatch\Core\Client\RawClient;
use Tradewatch\Stocks\Requests\StocksGetQuotesRequest;
use Tradewatch\Types\LastQuotes;
use Tradewatch\Exceptions\TradewatchException;
use Tradewatch\Exceptions\TradewatchApiException;
use Tradewatch\Core\Json\JsonApiRequest;
use Tradewatch\Environments;
use Tradewatch\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Tradewatch\Stocks\Requests\StocksGetQuoteRequest;
use Tradewatch\Types\LastQuote;
use Tradewatch\Stocks\Requests\StocksGetSymbolsRequest;
use Tradewatch\Types\CursorPageTCustomizedSymbolsOutFullStocks;
use Tradewatch\Stocks\Requests\StocksGetInsightsRequest;
use Tradewatch\Types\CursorPageTCustomizedNewsOut;
use Tradewatch\Types\CountriesList;
use Tradewatch\Stocks\Requests\StocksGetMarketsRequest;
use Tradewatch\Types\MarketResponse;
use Tradewatch\Core\Json\JsonDecoder;
use Tradewatch\Stocks\Requests\StocksGetMarketStatusRequest;
use Tradewatch\Types\MarketStatusResponse;
use Tradewatch\Stocks\Requests\StocksGetTradingHoursRequest;
use Tradewatch\Types\TradingHoursResponse;
use Tradewatch\Core\Json\JsonSerializer;
use Tradewatch\Stocks\Requests\StocksGetMarketHolidaysRequest;
use Tradewatch\Types\MarketHolidayResponse;
use Tradewatch\Types\StockDataFlatResponse;
use Tradewatch\Stocks\Requests\StocksGetHistoricalOhlcRequest;
use Tradewatch\Types\HistoricalOhlcResponse;
use Tradewatch\Stocks\Requests\StocksGetHistoricalTicksRequest;
use Tradewatch\Types\CursorPageTCustomizedHistoricalRawTick;

class StocksClient
{
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
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * Get the last quote tick for the provided symbols.
     *
     * @param StocksGetQuotesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return LastQuotes
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getQuotes(StocksGetQuotesRequest $request, ?array $options = null): LastQuotes
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['symbols'] = $request->symbols;
        if ($request->precision != null) {
            $query['precision'] = $request->precision;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/quotes",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return LastQuotes::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get the last quote tick for the provided symbol.
     *
     * @param StocksGetQuoteRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return LastQuote
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getQuote(StocksGetQuoteRequest $request, ?array $options = null): LastQuote
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['symbol'] = $request->symbol;
        if ($request->precision != null) {
            $query['precision'] = $request->precision;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/quote",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return LastQuote::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get list of available symbols
     *
     * @param StocksGetSymbolsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CursorPageTCustomizedSymbolsOutFullStocks
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getSymbols(StocksGetSymbolsRequest $request = new StocksGetSymbolsRequest(), ?array $options = null): CursorPageTCustomizedSymbolsOutFullStocks
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->size != null) {
            $query['size'] = $request->size;
        }
        if ($request->mode != null) {
            $query['mode'] = $request->mode;
        }
        if ($request->type != null) {
            $query['type'] = $request->type;
        }
        if ($request->country != null) {
            $query['country'] = $request->country;
        }
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/symbols",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CursorPageTCustomizedSymbolsOutFullStocks::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get recent stocks insights.
     *
     * @param StocksGetInsightsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CursorPageTCustomizedNewsOut
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getInsights(StocksGetInsightsRequest $request = new StocksGetInsightsRequest(), ?array $options = null): CursorPageTCustomizedNewsOut
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        if ($request->size != null) {
            $query['size'] = $request->size;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/insights",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CursorPageTCustomizedNewsOut::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get list of available countries
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CountriesList
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function stockGetCountries(?array $options = null): CountriesList
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/countries",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CountriesList::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get details about the markets available in this API.
     *
     * @param StocksGetMarketsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return array<MarketResponse>
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getMarkets(StocksGetMarketsRequest $request = new StocksGetMarketsRequest(), ?array $options = null): array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->mic != null) {
            $query['mic'] = $request->mic;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/markets",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [MarketResponse::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get the current status (open or closed) of a market. It takes holidays and half-days into account but does not factor in circuit breakers or halts.
     *
     * @param StocksGetMarketStatusRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return array<MarketStatusResponse>
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getMarketStatus(StocksGetMarketStatusRequest $request = new StocksGetMarketStatusRequest(), ?array $options = null): array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->mic != null) {
            $query['mic'] = $request->mic;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/markets/status",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [MarketStatusResponse::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get trading hours. It takes half-days into account.
     *
     * @param StocksGetTradingHoursRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return array<TradingHoursResponse>
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getTradingHours(StocksGetTradingHoursRequest $request, ?array $options = null): array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['start'] = JsonSerializer::serializeDate($request->start);
        $query['end'] = JsonSerializer::serializeDate($request->end);
        if ($request->mic != null) {
            $query['mic'] = $request->mic;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/markets/hours",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [TradingHoursResponse::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get market holidays. It takes half-days into account.
     *
     * @param StocksGetMarketHolidaysRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return array<MarketHolidayResponse>
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getMarketHolidays(StocksGetMarketHolidaysRequest $request, ?array $options = null): array
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['start'] = JsonSerializer::serializeDate($request->start);
        $query['end'] = JsonSerializer::serializeDate($request->end);
        if ($request->mic != null) {
            $query['mic'] = $request->mic;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/markets/holidays",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeArray($json, [MarketHolidayResponse::class]); // @phpstan-ignore-line
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * @param string $symbol
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return StockDataFlatResponse
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getStockData(string $symbol, ?array $options = null): StockDataFlatResponse
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/{$symbol}",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return StockDataFlatResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get historical OHLC candles for a symbol in a selected resolution and time range.
     *
     * @param string $symbol
     * @param StocksGetHistoricalOhlcRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return HistoricalOhlcResponse
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getHistoricalOhlc(string $symbol, StocksGetHistoricalOhlcRequest $request, ?array $options = null): HistoricalOhlcResponse
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['resolution'] = $request->resolution;
        $query['start'] = $request->start;
        $query['end'] = $request->end;
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/{$symbol}/ohlc",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return HistoricalOhlcResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Get raw historical ticks for a symbol in a selected time range using cursor pagination.
     *
     * @param string $symbol
     * @param StocksGetHistoricalTicksRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CursorPageTCustomizedHistoricalRawTick
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getHistoricalTicks(string $symbol, StocksGetHistoricalTicksRequest $request, ?array $options = null): CursorPageTCustomizedHistoricalRawTick
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        $query['start'] = $request->start;
        $query['end'] = $request->end;
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        if ($request->limit != null) {
            $query['limit'] = $request->limit;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "stocks/{$symbol}/ticks",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CursorPageTCustomizedHistoricalRawTick::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new TradewatchException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new TradewatchException(message: $e->getMessage(), previous: $e);
        }
        throw new TradewatchApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
