<?php

namespace Tradewatch\Crypto;

use Psr\Http\Client\ClientInterface;
use Tradewatch\Core\Client\RawClient;
use Tradewatch\Crypto\Requests\CryptoConvertRequest;
use Tradewatch\Types\CryptoConversion;
use Tradewatch\Exceptions\TradewatchException;
use Tradewatch\Exceptions\TradewatchApiException;
use Tradewatch\Core\Json\JsonApiRequest;
use Tradewatch\Environments;
use Tradewatch\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Tradewatch\Types\CryptoExchangesList;
use Tradewatch\Crypto\Requests\CryptoGetQuotesRequest;
use Tradewatch\Types\LastQuotes;
use Tradewatch\Crypto\Requests\CryptoGetQuoteRequest;
use Tradewatch\Types\LastQuote;
use Tradewatch\Crypto\Requests\CryptoGetSymbolsRequest;
use Tradewatch\Types\CursorPageTCustomizedSymbolsOutFull;
use Tradewatch\Crypto\Requests\CryptoGetInsightsRequest;
use Tradewatch\Types\CursorPageTCustomizedNewsOut;
use Tradewatch\Crypto\Requests\CryptoGetHistoricalOhlcRequest;
use Tradewatch\Types\HistoricalOhlcResponse;
use Tradewatch\Crypto\Requests\CryptoGetHistoricalTicksRequest;
use Tradewatch\Types\CursorPageTCustomizedHistoricalRawTick;

class CryptoClient
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
     * Convert one symbol to another
     *
     * @param string $from The symbol you want to convert from.
     * @param string $to The symbol you want to convert to.
     * @param CryptoConvertRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CryptoConversion
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function convert(string $from, string $to, CryptoConvertRequest $request = new CryptoConvertRequest(), ?array $options = null): CryptoConversion
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->amount != null) {
            $query['amount'] = $request->amount;
        }
        if ($request->precision != null) {
            $query['precision'] = $request->precision;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "crypto/convert/{$from}/{$to}",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CryptoConversion::fromJson($json);
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
     * Get list of available cryptocurrency exchanges
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CryptoExchangesList
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getExchanges(?array $options = null): CryptoExchangesList
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "crypto/exchanges",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CryptoExchangesList::fromJson($json);
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
     * Get the last quote tick for the provided symbols.
     *
     * @param CryptoGetQuotesRequest $request
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
    public function getQuotes(CryptoGetQuotesRequest $request, ?array $options = null): LastQuotes
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
                    path: "crypto/quotes",
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
     * @param CryptoGetQuoteRequest $request
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
    public function getQuote(CryptoGetQuoteRequest $request, ?array $options = null): LastQuote
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
                    path: "crypto/quote",
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
     * @param CryptoGetSymbolsRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CursorPageTCustomizedSymbolsOutFull
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getSymbols(CryptoGetSymbolsRequest $request = new CryptoGetSymbolsRequest(), ?array $options = null): CursorPageTCustomizedSymbolsOutFull
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
                    path: "crypto/symbols",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CursorPageTCustomizedSymbolsOutFull::fromJson($json);
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
     * Get recent crypto insights.
     *
     * @param CryptoGetInsightsRequest $request
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
    public function getInsights(CryptoGetInsightsRequest $request = new CryptoGetInsightsRequest(), ?array $options = null): CursorPageTCustomizedNewsOut
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
                    path: "crypto/insights",
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
     * Get historical OHLC candles for a symbol in a selected resolution and time range.
     *
     * @param string $symbol
     * @param CryptoGetHistoricalOhlcRequest $request
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
    public function getHistoricalOhlc(string $symbol, CryptoGetHistoricalOhlcRequest $request, ?array $options = null): HistoricalOhlcResponse
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
                    path: "crypto/{$symbol}/ohlc",
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
     * @param CryptoGetHistoricalTicksRequest $request
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
    public function getHistoricalTicks(string $symbol, CryptoGetHistoricalTicksRequest $request, ?array $options = null): CursorPageTCustomizedHistoricalRawTick
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
                    path: "crypto/{$symbol}/ticks",
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
