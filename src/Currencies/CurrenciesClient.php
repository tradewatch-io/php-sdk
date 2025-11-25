<?php

namespace Tradewatch\Currencies;

use Psr\Http\Client\ClientInterface;
use Tradewatch\Core\Client\RawClient;
use Tradewatch\Currencies\Requests\CurrenciesConvertRequest;
use Tradewatch\Types\Conversion;
use Tradewatch\Exceptions\TradewatchException;
use Tradewatch\Exceptions\TradewatchApiException;
use Tradewatch\Core\Json\JsonApiRequest;
use Tradewatch\Environments;
use Tradewatch\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Tradewatch\Currencies\Requests\CurrenciesGetQuotesRequest;
use Tradewatch\Types\LastQuotes;
use Tradewatch\Currencies\Requests\CurrenciesGetQuoteRequest;
use Tradewatch\Types\LastQuote;
use Tradewatch\Currencies\Requests\CurrenciesGetSymbolsRequest;
use Tradewatch\Types\CursorPageTCustomizedSymbolsOutFull;
use Tradewatch\Currencies\Requests\CurrenciesGetInsightsRequest;
use Tradewatch\Types\CursorPageTCustomizedNewsOut;

class CurrenciesClient
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
     * @param CurrenciesConvertRequest $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Conversion
     * @throws TradewatchException
     * @throws TradewatchApiException
     */
    public function convert(string $from, string $to, CurrenciesConvertRequest $request = new CurrenciesConvertRequest(), ?array $options = null): Conversion
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
                    path: "currencies/convert/{$from}/{$to}",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return Conversion::fromJson($json);
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
     * @param CurrenciesGetQuotesRequest $request
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
    public function getQuotes(CurrenciesGetQuotesRequest $request, ?array $options = null): LastQuotes
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
                    path: "currencies/quotes",
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
     * @param CurrenciesGetQuoteRequest $request
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
    public function getQuote(CurrenciesGetQuoteRequest $request, ?array $options = null): LastQuote
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
                    path: "currencies/quote",
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
     * @param CurrenciesGetSymbolsRequest $request
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
    public function getSymbols(CurrenciesGetSymbolsRequest $request = new CurrenciesGetSymbolsRequest(), ?array $options = null): CursorPageTCustomizedSymbolsOutFull
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
                    path: "currencies/symbols",
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
     * Get recent currencies insights.
     *
     * @param CurrenciesGetInsightsRequest $request
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
    public function getInsights(CurrenciesGetInsightsRequest $request = new CurrenciesGetInsightsRequest(), ?array $options = null): CursorPageTCustomizedNewsOut
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
                    path: "currencies/insights",
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
}
