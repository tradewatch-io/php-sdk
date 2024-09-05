# OpenAPI\Client\CryptoApi

All URIs are relative to https://api.tradewatch.io, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**convert()**](CryptoApi.md#convert) | **GET** /crypto/convert/{from}/{to} | Conversion |
| [**getQuote()**](CryptoApi.md#getQuote) | **GET** /crypto/symbols/{symbol} | Last Quote |
| [**getSymbols()**](CryptoApi.md#getSymbols) | **GET** /crypto/symbols | Available Symbols |


## `convert()`

```php
convert($from, $to): \OpenAPI\Client\Model\CryptoConversion
```

Conversion

Convert one symbol to another

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key_query
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');

// Configure API key authorization: api_key_header
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CryptoApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$from = 'from_example'; // string
$to = 'to_example'; // string

try {
    $result = $apiInstance->convert($from, $to);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CryptoApi->convert: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **from** | **string**|  | |
| **to** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\CryptoConversion**](../Model/CryptoConversion.md)

### Authorization

[api_key_query](../../README.md#api_key_query), [api_key_header](../../README.md#api_key_header)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getQuote()`

```php
getQuote($symbol, $precision): \OpenAPI\Client\Model\LastQuote
```

Last Quote

Get the last quote tick for the provided symbol.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key_query
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');

// Configure API key authorization: api_key_header
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CryptoApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$symbol = 'symbol_example'; // string
$precision = 8; // int

try {
    $result = $apiInstance->getQuote($symbol, $precision);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CryptoApi->getQuote: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **symbol** | **string**|  | |
| **precision** | **int**|  | [optional] [default to 8] |

### Return type

[**\OpenAPI\Client\Model\LastQuote**](../Model/LastQuote.md)

### Authorization

[api_key_query](../../README.md#api_key_query), [api_key_header](../../README.md#api_key_header)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSymbols()`

```php
getSymbols($mode, $size, $page, $cursor): \OpenAPI\Client\Model\CursorPageTCustomizedSymbolsOutFull
```

Available Symbols

Get list of available symbols

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: api_key_query
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');

// Configure API key authorization: api_key_header
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\CryptoApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mode = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\SymbolsListMode(); // \OpenAPI\Client\Model\SymbolsListMode | Listing mode
$size = 50; // int | Page offset
$page = 1; // int | Page number
$cursor = 'cursor_example'; // string | Cursor for the next page

try {
    $result = $apiInstance->getSymbols($mode, $size, $page, $cursor);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CryptoApi->getSymbols: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **mode** | [**\OpenAPI\Client\Model\SymbolsListMode**](../Model/.md)| Listing mode | |
| **size** | **int**| Page offset | [optional] [default to 50] |
| **page** | **int**| Page number | [optional] [default to 1] |
| **cursor** | **string**| Cursor for the next page | [optional] |

### Return type

[**\OpenAPI\Client\Model\CursorPageTCustomizedSymbolsOutFull**](../Model/CursorPageTCustomizedSymbolsOutFull.md)

### Authorization

[api_key_query](../../README.md#api_key_query), [api_key_header](../../README.md#api_key_header)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
