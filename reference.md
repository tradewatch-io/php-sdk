# Reference
## account
<details><summary><code>$client-&gt;account-&gt;getUsage($request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the usage statistics of your API account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->account->getUsage(
    new AccountGetUsageRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$limit:** `?int` — The number of data points to return (max 168).
    
</dd>
</dl>

<dl>
<dd>

**$interval:** `?string` — The time interval for the usage statistics.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## currencies
<details><summary><code>$client-&gt;currencies-&gt;convert($from, $to, $request) -> Conversion</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Convert one symbol to another
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->currencies->convert(
    'EUR',
    'USD',
    new CurrenciesConvertRequest([
        'amount' => 1000,
        'precision' => 2,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `string` — The symbol you want to convert from.
    
</dd>
</dl>

<dl>
<dd>

**$to:** `string` — The symbol you want to convert to.
    
</dd>
</dl>

<dl>
<dd>

**$amount:** `?float` — The amount to be converted.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;currencies-&gt;getQuotes($request) -> LastQuotes</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbols.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->currencies->getQuotes(
    new CurrenciesGetQuotesRequest([
        'symbols' => 'symbols',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbols:** `string` — Comma separated list of symbols.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;currencies-&gt;getQuote($request) -> LastQuote</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbol.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->currencies->getQuote(
    new CurrenciesGetQuoteRequest([
        'symbol' => 'EURUSD',
        'precision' => 4,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` — The symbol to get the quote for.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;currencies-&gt;getSymbols($request) -> CursorPageTCustomizedSymbolsOutFull</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available symbols
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->currencies->getSymbols(
    new CurrenciesGetSymbolsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?string` — The mode of the response.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — Type of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `?string` — Country of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;currencies-&gt;getInsights($request) -> CursorPageTCustomizedNewsOut</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get recent currencies insights.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->currencies->getInsights(
    new CurrenciesGetInsightsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;currencies-&gt;getHistoricalOhlc($symbol, $request) -> HistoricalOhlcResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get historical OHLC candles for a symbol in a selected resolution and time range.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->currencies->getHistoricalOhlc(
    'symbol',
    new CurrenciesGetHistoricalOhlcRequest([
        'resolution' => HistoricalDataResolution::Value5->value,
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$resolution:** `string` — Resolution in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;currencies-&gt;getHistoricalTicks($symbol, $request) -> CursorPageTCustomizedHistoricalRawTick</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get raw historical ticks for a symbol in a selected time range using cursor pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->currencies->getHistoricalTicks(
    'symbol',
    new CurrenciesGetHistoricalTicksRequest([
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — The number of ticks per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## crypto
<details><summary><code>$client-&gt;crypto-&gt;convert($from, $to, $request) -> CryptoConversion</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Convert one symbol to another
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->convert(
    'from',
    'to',
    new CryptoConvertRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$from:** `string` — The symbol you want to convert from.
    
</dd>
</dl>

<dl>
<dd>

**$to:** `string` — The symbol you want to convert to.
    
</dd>
</dl>

<dl>
<dd>

**$amount:** `?float` — The amount to be converted.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;crypto-&gt;getExchanges() -> CryptoExchangesList</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available cryptocurrency exchanges
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->getExchanges();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;crypto-&gt;getQuotes($request) -> LastQuotes</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbols.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->getQuotes(
    new CryptoGetQuotesRequest([
        'symbols' => 'BTCUSD,SOLUSD',
        'precision' => 2,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbols:** `string` — Comma separated list of symbols.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;crypto-&gt;getQuote($request) -> LastQuote</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbol.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->getQuote(
    new CryptoGetQuoteRequest([
        'symbol' => 'BTCUSD',
        'precision' => 2,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` — The symbol to get the quote for.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;crypto-&gt;getSymbols($request) -> CursorPageTCustomizedSymbolsOutFull</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available symbols
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->getSymbols(
    new CryptoGetSymbolsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?string` — The mode of the response.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — Type of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `?string` — Country of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;crypto-&gt;getInsights($request) -> CursorPageTCustomizedNewsOut</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get recent crypto insights.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->getInsights(
    new CryptoGetInsightsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;crypto-&gt;getHistoricalOhlc($symbol, $request) -> HistoricalOhlcResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get historical OHLC candles for a symbol in a selected resolution and time range.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->getHistoricalOhlc(
    'symbol',
    new CryptoGetHistoricalOhlcRequest([
        'resolution' => HistoricalDataResolution::Value5->value,
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$resolution:** `string` — Resolution in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;crypto-&gt;getHistoricalTicks($symbol, $request) -> CursorPageTCustomizedHistoricalRawTick</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get raw historical ticks for a symbol in a selected time range using cursor pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->crypto->getHistoricalTicks(
    'symbol',
    new CryptoGetHistoricalTicksRequest([
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — The number of ticks per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## indices
<details><summary><code>$client-&gt;indices-&gt;getQuotes($request) -> LastQuotes</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbols.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->indices->getQuotes(
    new IndicesGetQuotesRequest([
        'symbols' => 'symbols',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbols:** `string` — Comma separated list of symbols.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;indices-&gt;getQuote($request) -> LastQuote</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbol.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->indices->getQuote(
    new IndicesGetQuoteRequest([
        'symbol' => 'DJI',
        'precision' => 2,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` — The symbol to get the quote for.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;indices-&gt;getSymbols($request) -> CursorPageTCustomizedSymbolsOutFull</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available symbols
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->indices->getSymbols(
    new IndicesGetSymbolsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?string` — The mode of the response.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — Type of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `?string` — Country of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;indices-&gt;getInsights($request) -> CursorPageTCustomizedNewsOut</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get recent indices insights.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->indices->getInsights(
    new IndicesGetInsightsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;indices-&gt;getHistoricalOhlc($symbol, $request) -> HistoricalOhlcResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get historical OHLC candles for a symbol in a selected resolution and time range.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->indices->getHistoricalOhlc(
    'symbol',
    new IndicesGetHistoricalOhlcRequest([
        'resolution' => HistoricalDataResolution::Value5->value,
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$resolution:** `string` — Resolution in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;indices-&gt;getHistoricalTicks($symbol, $request) -> CursorPageTCustomizedHistoricalRawTick</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get raw historical ticks for a symbol in a selected time range using cursor pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->indices->getHistoricalTicks(
    'symbol',
    new IndicesGetHistoricalTicksRequest([
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — The number of ticks per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## stocks
<details><summary><code>$client-&gt;stocks-&gt;getQuotes($request) -> LastQuotes</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbols.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getQuotes(
    new StocksGetQuotesRequest([
        'symbols' => 'symbols',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbols:** `string` — Comma separated list of symbols.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getQuote($request) -> LastQuote</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbol.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getQuote(
    new StocksGetQuoteRequest([
        'symbol' => 'symbol',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` — The symbol to get the quote for.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getSymbols($request) -> CursorPageTCustomizedSymbolsOutFullStocks</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available symbols
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getSymbols(
    new StocksGetSymbolsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?string` — The mode of the response.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — Type of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `?string` — Country of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getInsights($request) -> CursorPageTCustomizedNewsOut</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get recent stocks insights.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getInsights(
    new StocksGetInsightsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;stockGetCountries() -> CountriesList</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available countries
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->stockGetCountries();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getMarkets($request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get details about the markets available in this API.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getMarkets(
    new StocksGetMarketsRequest([
        'mic' => 'XNYS',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mic:** `?string` — Optional list of comma separated MIC codes for which market to show data for. All market will be included if MIC code is not specified.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getMarketStatus($request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the current status (open or closed) of a market. It takes holidays and half-days into account but does not factor in circuit breakers or halts.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getMarketStatus(
    new StocksGetMarketStatusRequest([
        'mic' => 'XNYS',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mic:** `?string` — Optional list of comma separated MIC codes for which market to show data for. All market will be included if MIC code is not specified.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getTradingHours($request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get trading hours. It takes half-days into account.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getTradingHours(
    new StocksGetTradingHoursRequest([
        'mic' => 'XNAS',
        'start' => new DateTime('2025-01-01'),
        'end' => new DateTime('2025-01-31'),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mic:** `?string` — Optional list of comma separated MIC codes for which market to show data for. All market will be included if MIC code is not specified.
    
</dd>
</dl>

<dl>
<dd>

**$start:** `DateTime` — Show holidays starting at this date.
    
</dd>
</dl>

<dl>
<dd>

**$end:** `DateTime` — Show holidays until this date.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getMarketHolidays($request) -> array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get market holidays. It takes half-days into account.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getMarketHolidays(
    new StocksGetMarketHolidaysRequest([
        'mic' => 'XNYS',
        'start' => new DateTime('2026-02-20'),
        'end' => new DateTime('2026-02-27'),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mic:** `?string` — Specify comma separated list of MIC codes for which market to show data for.
    
</dd>
</dl>

<dl>
<dd>

**$start:** `DateTime` — Show holidays starting at this date.
    
</dd>
</dl>

<dl>
<dd>

**$end:** `DateTime` — Show holidays until this date.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getStockData($symbol) -> StockDataFlatResponse</code></summary>
<dl>
<dd>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getStockData(
    'AAPL',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getHistoricalOhlc($symbol, $request) -> HistoricalOhlcResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get historical OHLC candles for a symbol in a selected resolution and time range.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getHistoricalOhlc(
    'symbol',
    new StocksGetHistoricalOhlcRequest([
        'resolution' => HistoricalDataResolution::Value5->value,
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$resolution:** `string` — Resolution in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;stocks-&gt;getHistoricalTicks($symbol, $request) -> CursorPageTCustomizedHistoricalRawTick</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get raw historical ticks for a symbol in a selected time range using cursor pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->stocks->getHistoricalTicks(
    'symbol',
    new StocksGetHistoricalTicksRequest([
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — The number of ticks per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## commodities
<details><summary><code>$client-&gt;commodities-&gt;getQuotes($request) -> LastQuotes</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbols.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->commodities->getQuotes(
    new CommoditiesGetQuotesRequest([
        'symbols' => 'symbols',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbols:** `string` — Comma separated list of symbols.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;commodities-&gt;getQuote($request) -> LastQuote</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the last quote tick for the provided symbol.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->commodities->getQuote(
    new CommoditiesGetQuoteRequest([
        'symbol' => 'GOLD',
        'precision' => 2,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` — The symbol to get the quote for.
    
</dd>
</dl>

<dl>
<dd>

**$precision:** `?int` — The decimal precision of the result.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;commodities-&gt;getSymbols($request) -> CursorPageTCustomizedSymbolsOutFull</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available symbols
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->commodities->getSymbols(
    new CommoditiesGetSymbolsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?string` — The mode of the response.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?string` — Type of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$country:** `?string` — Country of the instrument.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;commodities-&gt;getInsights($request) -> CursorPageTCustomizedNewsOut</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get recent commodities insights.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->commodities->getInsights(
    new CommoditiesGetInsightsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$size:** `?int` — The number of items per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;commodities-&gt;getTypes() -> CommodityTypesList</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get list of available commodity types
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->commodities->getTypes();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;commodities-&gt;getHistoricalOhlc($symbol, $request) -> HistoricalOhlcResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get historical OHLC candles for a symbol in a selected resolution and time range.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->commodities->getHistoricalOhlc(
    'symbol',
    new CommoditiesGetHistoricalOhlcRequest([
        'resolution' => HistoricalDataResolution::Value5->value,
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$resolution:** `string` — Resolution in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;commodities-&gt;getHistoricalTicks($symbol, $request) -> CursorPageTCustomizedHistoricalRawTick</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get raw historical ticks for a symbol in a selected time range using cursor pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->commodities->getHistoricalTicks(
    'symbol',
    new CommoditiesGetHistoricalTicksRequest([
        'start' => 1,
        'end' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$symbol:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$start:** `int` — Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$end:** `int` — Unix timestamp (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — The number of ticks per page.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>
