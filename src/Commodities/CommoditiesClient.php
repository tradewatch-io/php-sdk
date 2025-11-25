<?php

namespace Tradewatch\Commodities;

use Psr\Http\Client\ClientInterface;
use Tradewatch\Core\Client\RawClient;
use Tradewatch\Commodities\Requests\CommoditiesGetQuotesRequest;
use Tradewatch\Types\LastQuotes;
use Tradewatch\Exceptions\TradewatchException;
use Tradewatch\Exceptions\TradewatchApiException;
use Tradewatch\Core\Json\JsonApiRequest;
use Tradewatch\Environments;
use Tradewatch\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Tradewatch\Commodities\Requests\CommoditiesGetQuoteRequest;
use Tradewatch\Types\LastQuote;
use Tradewatch\Commodities\Requests\CommoditiesGetSymbolsRequest;
use Tradewatch\Types\CursorPageTCustomizedSymbolsOutFull;
use Tradewatch\Commodities\Requests\CommoditiesGetInsightsRequest;
use Tradewatch\Types\CursorPageTCustomizedNewsOut;
use Tradewatch\Types\CommodityTypesList;

class CommoditiesClient
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
     * @param CommoditiesGetQuotesRequest $request
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
    public function getQuotes(CommoditiesGetQuotesRequest $request, ?array $options = null): LastQuotes
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
                    path: "commodities/quotes",
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
     * @param CommoditiesGetQuoteRequest $request
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
    public function getQuote(CommoditiesGetQuoteRequest $request, ?array $options = null): LastQuote
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
                    path: "commodities/quote",
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
     * @param CommoditiesGetSymbolsRequest $request
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
    public function getSymbols(CommoditiesGetSymbolsRequest $request = new CommoditiesGetSymbolsRequest(), ?array $options = null): CursorPageTCustomizedSymbolsOutFull
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
                    path: "commodities/symbols",
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
     * Get recent commodities insights.
     *
     * @param CommoditiesGetInsightsRequest $request
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
    public function getInsights(CommoditiesGetInsightsRequest $request = new CommoditiesGetInsightsRequest(), ?array $options = null): CursorPageTCustomizedNewsOut
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
                    path: "commodities/insights",
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
     * Get list of available commodity types
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return CommodityTypesList
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function getTypes(?array $options = null): CommodityTypesList
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "commodities/types",
                    method: HttpMethod::GET,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return CommodityTypesList::fromJson($json);
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
