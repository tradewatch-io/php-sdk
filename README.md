# TradeWatch.io PHP SDK

![](https://tradewatch.io/)

[![php shield](https://img.shields.io/badge/php-packagist-pink)](https://packagist.org/packages/tradewatch/tradewatch)

<a href="https://tradewatch.io/">
  <img src="https://pub-e8bb70a6cc1844138d6a55fa4a44ba42.r2.dev/logo-purple.png" alt="TradeWatch.io logo" title="TradeWatch.io" align="right" height="60" />
</a>

Official SDK for the [TradeWatch.io API](https://tradewatch.io/docs/api-reference/introduction).

## Other SDKs
[![Python SDK](https://img.shields.io/badge/Python_SDK-3776AB?style=flat-square&logo=python&logoColor=white)](https://github.com/tradewatch-io/python-sdk)
[![TypeScript SDK](https://img.shields.io/badge/TypeScript_SDK-3178C6?style=flat-square&logo=typescript&logoColor=white)](https://github.com/tradewatch-io/typescript-sdk)
[![.NET SDK](https://img.shields.io/badge/.NET_SDK-512BD4?style=flat-square&logo=dotnet&logoColor=white)](https://github.com/tradewatch-io/dotnet-sdk)
[![Java SDK](https://img.shields.io/badge/Java_SDK-ED8B00?style=flat-square&logo=openjdk&logoColor=white)](https://github.com/tradewatch-io/java-sdk)
[![Go SDK](https://img.shields.io/badge/Go_SDK-00ADD8?style=flat-square&logo=go&logoColor=white)](https://github.com/tradewatch-io/go-sdk)
[![Ruby SDK](https://img.shields.io/badge/Ruby_SDK-CC342D?style=flat-square&logo=ruby&logoColor=white)](https://github.com/tradewatch-io/ruby-sdk)
[![Swift SDK](https://img.shields.io/badge/Swift_SDK-FA7343?style=flat-square&logo=swift&logoColor=white)](https://github.com/tradewatch-io/swift-sdk)
[![Rust SDK](https://img.shields.io/badge/Rust_SDK-000000?style=flat-square&logo=rust&logoColor=white)](https://github.com/tradewatch-io/rust-sdk)
## What is TradeWatch.io?
TradeWatch.io is a market data platform and API for real-time and historical prices across crypto, stocks, indices, currencies, and commodities.

## Try the Interactive API Playground
Want to test endpoints without writing code first? Use the [TradeWatch Interactive API Playground](https://dash.tradewatch.io/api-explorer) to run requests directly in your browser.

[![TradeWatch Interactive API Playground](https://tradewatch.io/api-playground.png)](https://dash.tradewatch.io/api-explorer)

## Resources

- REST API reference: [https://tradewatch.io/docs/api-reference/introduction](https://tradewatch.io/docs/api-reference/introduction)
- WebSocket API reference: [https://tradewatch.io/docs/websocket-api/introduction](https://tradewatch.io/docs/websocket-api/introduction)
- Support channels: [https://tradewatch.io/docs/platform/support](https://tradewatch.io/docs/platform/support)

## Quick Start
1. Create an API key in the [TradeWatch Dashboard](https://dash.tradewatch.io/register).
2. Follow platform setup docs: [Getting started](https://tradewatch.io/docs/quickstart).


## Table of Contents

- [Documentation](#documentation)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Exception Handling](#exception-handling)
- [Advanced](#advanced)
  - [Custom Client](#custom-client)
  - [Retries](#retries)
  - [Timeouts](#timeouts)
- [Contributing](#contributing)

## Documentation

API reference documentation is available [here](https://tradewatch.io/docs/api-reference/introduction).

## Requirements

This SDK requires PHP ^8.1.

## Installation

```sh
composer require tradewatch/tradewatch
```

## Usage

Instantiate and use the client with the following:

```php
<?php

namespace Example;

use Tradewatch\TradewatchClient;
use Tradewatch\Crypto\Requests\CryptoGetQuoteRequest;

$client = new TradewatchClient(
    apiKey: '<value>',
);
$client->crypto->getQuote(
    new CryptoGetQuoteRequest([
        'symbol' => 'BTC-USD',
        'precision' => 2,
    ]),
);

```

## Exception Handling

When the API returns a non-success status code (4xx or 5xx response), an exception will be thrown.

```php
use Tradewatch\Exceptions\TradewatchApiException;
use Tradewatch\Exceptions\TradewatchException;

try {
    $response = $client->crypto->getQuote(...);
} catch (TradewatchApiException $e) {
    echo 'API Exception occurred: ' . $e->getMessage() . "\n";
    echo 'Status Code: ' . $e->getCode() . "\n";
    echo 'Response Body: ' . $e->getBody() . "\n";
    // Optionally, rethrow the exception or handle accordingly.
}
```

## Advanced

### Custom Client

This SDK is built to work with any HTTP client that implements the [PSR-18](https://www.php-fig.org/psr/psr-18/) `ClientInterface`.
By default, if no client is provided, the SDK will use `php-http/discovery` to find an installed HTTP client.
However, you can pass your own client that adheres to `ClientInterface`:

```php
use Tradewatch\TradewatchClient;

// Pass any PSR-18 compatible HTTP client implementation.
// For example, using Guzzle:
$customClient = new \GuzzleHttp\Client([
    'timeout' => 5.0,
]);

$client = new TradewatchClient(options: [
    'client' => $customClient
]);

// Or using Symfony HttpClient:
// $customClient = (new \Symfony\Component\HttpClient\Psr18Client())
//     ->withOptions(['timeout' => 5.0]);
//
// $client = new TradewatchClient(options: [
//     'client' => $customClient
// ]);
```

### Retries

The SDK is instrumented with automatic retries with exponential backoff. A request will be retried as long
as the request is deemed retryable and the number of retry attempts has not grown larger than the configured
retry limit (default: 2).

A request is deemed retryable when any of the following HTTP status codes is returned:

- [408](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/408) (Timeout)
- [429](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/429) (Too Many Requests)
- [5XX](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/500) (Internal Server Errors)

Use the `maxRetries` request option to configure this behavior.

```php
$response = $client->crypto->getQuote(
    ...,
    options: [
        'maxRetries' => 0 // Override maxRetries at the request level
    ]
);
```

### Timeouts

The SDK defaults to a 30 second timeout. Use the `timeout` option to configure this behavior.

```php
$response = $client->crypto->getQuote(
    ...,
    options: [
        'timeout' => 3.0 // Override timeout at the request level
    ]
);
```

## Contributing

While we value open-source contributions to this SDK, this library is generated programmatically.
Additions made directly to this library would have to be moved over to our generation code,
otherwise they would be overwritten upon the next generated release. Feel free to open a PR as
a proof of concept, but know that we will not be able to merge it as-is. We suggest opening
an issue first to discuss with us!

On the other hand, contributions to the README are always very welcome!
## Available Methods

### `account`

| Method | Required Params | Summary | Description |
| --- | --- | --- | --- |
| [`getUsage()`](https://tradewatch.io/docs/api-reference/account/usage-statistics) | - | Usage statistics | Get the usage statistics of your API account |

### `currencies`

| Method | Required Params | Summary | Description |
| --- | --- | --- | --- |
| [`convert(from, to)`](https://tradewatch.io/docs/api-reference/currencies/conversion) | from, to | Conversion | Convert one symbol to another |
| [`getInsights()`](https://tradewatch.io/docs/api-reference/currencies/get-insights) | - | Get Insights | Get recent currencies insights. |
| [`getQuote(symbol)`](https://tradewatch.io/docs/api-reference/currencies/last-quote) | symbol | Last Quote | Get the last quote tick for the provided symbol. |
| [`getQuotes(symbols)`](https://tradewatch.io/docs/api-reference/currencies/last-quotes) | symbols | Last Quotes | Get the last quote tick for the provided symbols. |
| [`getSymbols()`](https://tradewatch.io/docs/api-reference/currencies/available-symbols) | - | Available Symbols | Get list of available symbols |

### `crypto`

| Method | Required Params | Summary | Description |
| --- | --- | --- | --- |
| [`convert(from, to)`](https://tradewatch.io/docs/api-reference/crypto/conversion) | from, to | Conversion | Convert one symbol to another |
| [`getExchanges()`](https://tradewatch.io/docs/api-reference/crypto/available-exchanges) | - | Available Exchanges | Get list of available cryptocurrency exchanges |
| [`getInsights()`](https://tradewatch.io/docs/api-reference/crypto/get-insights) | - | Get Insights | Get recent crypto insights. |
| [`getQuote(symbol)`](https://tradewatch.io/docs/api-reference/crypto/last-quote) | symbol | Last Quote | Get the last quote tick for the provided symbol. |
| [`getQuotes(symbols)`](https://tradewatch.io/docs/api-reference/crypto/last-quotes) | symbols | Last Quotes | Get the last quote tick for the provided symbols. |
| [`getSymbols()`](https://tradewatch.io/docs/api-reference/crypto/available-symbols) | - | Available Symbols | Get list of available symbols |

### `indices`

| Method | Required Params | Summary | Description |
| --- | --- | --- | --- |
| [`getInsights()`](https://tradewatch.io/docs/api-reference/indices/get-insights) | - | Get Insights | Get recent indices insights. |
| [`getQuote(symbol)`](https://tradewatch.io/docs/api-reference/indices/last-quote) | symbol | Last Quote | Get the last quote tick for the provided symbol. |
| [`getQuotes(symbols)`](https://tradewatch.io/docs/api-reference/indices/last-quotes) | symbols | Last Quotes | Get the last quote tick for the provided symbols. |
| [`getSymbols()`](https://tradewatch.io/docs/api-reference/indices/available-symbols) | - | Available Symbols | Get list of available symbols |

### `stocks`

| Method | Required Params | Summary | Description |
| --- | --- | --- | --- |
| [`getHistoricalOhlc(symbol, resolution, start, end)`](https://tradewatch.io/docs/api-reference/stocks/get-historical-ohlc) | symbol, resolution, start, end | Get Historical Ohlc | Get historical OHLC candles for a symbol in a selected resolution and time range. |
| [`getHistoricalTicks(symbol, start, end)`](https://tradewatch.io/docs/api-reference/stocks/get-historical-ticks) | symbol, start, end | Get Historical Ticks | Get raw historical ticks for a symbol in a selected time range using cursor pagination. |
| [`getInsights()`](https://tradewatch.io/docs/api-reference/stocks/get-insights) | - | Get Insights | Get recent stocks insights. |
| [`getMarketHolidays(start, end)`](https://tradewatch.io/docs/api-reference/stocks/get-market-holidays) | start, end | Get Market Holidays | Get market holidays. It takes half-days into account. |
| [`getMarketStatus()`](https://tradewatch.io/docs/api-reference/stocks/get-market-status) | - | Get Market Status | Get the current status (open or closed) of a market. It takes holidays and half-days into account but does not factor in circuit breakers or halts. |
| [`getMarkets()`](https://tradewatch.io/docs/api-reference/stocks/get-markets) | - | Get Markets | Get details about the markets available in this API. |
| [`getQuote(symbol)`](https://tradewatch.io/docs/api-reference/stocks/last-quote) | symbol | Last Quote | Get the last quote tick for the provided symbol. |
| [`getQuotes(symbols)`](https://tradewatch.io/docs/api-reference/stocks/last-quotes) | symbols | Last Quotes | Get the last quote tick for the provided symbols. |
| [`getStockData(symbol)`](https://tradewatch.io/docs/api-reference/stocks/get-stock-data) | symbol | Get Stock Data | Get Stock Data |
| [`getSymbols()`](https://tradewatch.io/docs/api-reference/stocks/available-symbols) | - | Available Symbols | Get list of available symbols |
| [`getTradingHours(start, end)`](https://tradewatch.io/docs/api-reference/stocks/get-trading-hours) | start, end | Get Trading Hours | Get trading hours. It takes half-days into account. |
| [`stockGetCountries()`](https://tradewatch.io/docs/api-reference/stocks/available-countries) | - | Available Countries | Get list of available countries |

### `commodities`

| Method | Required Params | Summary | Description |
| --- | --- | --- | --- |
| [`getInsights()`](https://tradewatch.io/docs/api-reference/commodities/get-insights) | - | Get Insights | Get recent commodities insights. |
| [`getQuote(symbol)`](https://tradewatch.io/docs/api-reference/commodities/last-quote) | symbol | Last Quote | Get the last quote tick for the provided symbol. |
| [`getQuotes(symbols)`](https://tradewatch.io/docs/api-reference/commodities/last-quotes) | symbols | Last Quotes | Get the last quote tick for the provided symbols. |
| [`getSymbols()`](https://tradewatch.io/docs/api-reference/commodities/available-symbols) | - | Available Symbols | Get list of available symbols |
| [`getTypes()`](https://tradewatch.io/docs/api-reference/commodities/available-types) | - | Available Types | Get list of available commodity types |
