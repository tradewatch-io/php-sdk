<?php

namespace Tradewatch\Indices;

use Psr\Http\Client\ClientInterface;
use Tradewatch\Core\Client\RawClient;
use Tradewatch\Indices\Requests\IndicesGetQuotesRequest;
use Tradewatch\Types\LastQuotes;
use Tradewatch\Exceptions\TradewatchException;
use Tradewatch\Exceptions\TradewatchApiException;
use Tradewatch\Core\Json\JsonApiRequest;
use Tradewatch\Environments;
use Tradewatch\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Tradewatch\Indices\Requests\IndicesGetQuoteRequest;
use Tradewatch\Types\LastQuote;
use Tradewatch\Indices\Requests\IndicesGetSymbolsRequest;
use Tradewatch\Types\CursorPageTCustomizedSymbolsOutFull;
use Tradewatch\Indices\Requests\IndicesGetInsightsRequest;
use Tradewatch\Types\CursorPageTCustomizedNewsOut;
use Tradewatch\Indices\Requests\IndicesGetHistoricalOhlcRequest;
use Tradewatch\Types\HistoricalOhlcResponse;
use Tradewatch\Indices\Requests\IndicesGetHistoricalTicksRequest;
use Tradewatch\Types\CursorPageTCustomizedHistoricalRawTick;

class IndicesClient
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
     * @param IndicesGetQuotesRequest $request
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
    public function getQuotes(IndicesGetQuotesRequest $request, ?array $options = null): LastQuotes
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
                    path: "indices/quotes",
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
     * @param IndicesGetQuoteRequest $request
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
    public function getQuote(IndicesGetQuoteRequest $request, ?array $options = null): LastQuote
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
                    path: "indices/quote",
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
     * @param IndicesGetSymbolsRequest $request
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
    public function getSymbols(IndicesGetSymbolsRequest $request = new IndicesGetSymbolsRequest(), ?array $options = null): CursorPageTCustomizedSymbolsOutFull
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
                    path: "indices/symbols",
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
     * Get recent indices insights.
     *
     * @param IndicesGetInsightsRequest $request
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
    public function getInsights(IndicesGetInsightsRequest $request = new IndicesGetInsightsRequest(), ?array $options = null): CursorPageTCustomizedNewsOut
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
                    path: "indices/insights",
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
     * @param IndicesGetHistoricalOhlcRequest $request
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
    public function getHistoricalOhlc(string $symbol, IndicesGetHistoricalOhlcRequest $request, ?array $options = null): HistoricalOhlcResponse
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
                    path: "indices/{$symbol}/ohlc",
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
     * @param IndicesGetHistoricalTicksRequest $request
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
    public function getHistoricalTicks(string $symbol, IndicesGetHistoricalTicksRequest $request, ?array $options = null): CursorPageTCustomizedHistoricalRawTick
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
                    path: "indices/{$symbol}/ticks",
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
