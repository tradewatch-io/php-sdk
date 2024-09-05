# OpenAPI\Client\IndicesApi

All URIs are relative to https://api.tradewatch.io, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getQuote()**](IndicesApi.md#getQuote) | **GET** /indices/symbols/{symbol} | Last Quote |
| [**getSymbols()**](IndicesApi.md#getSymbols) | **GET** /indices/symbols | Available Symbols |


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


$apiInstance = new OpenAPI\Client\Api\IndicesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$symbol = 'symbol_example'; // string
$precision = 5; // int

try {
    $result = $apiInstance->getQuote($symbol, $precision);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndicesApi->getQuote: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **symbol** | **string**|  | |
| **precision** | **int**|  | [optional] [default to 5] |

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


$apiInstance = new OpenAPI\Client\Api\IndicesApi(
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
    echo 'Exception when calling IndicesApi->getSymbols: ', $e->getMessage(), PHP_EOL;
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
