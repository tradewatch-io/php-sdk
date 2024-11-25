# OpenAPI\Client\AccountApi

All URIs are relative to https://api.tradewatch.io, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getUsage()**](AccountApi.md#getUsage) | **GET** /account/usage | Usage statistics |


## `getUsage()`

```php
getUsage($limit, $interval): object
```

Usage statistics

Get the usage statistics of your API account

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


$apiInstance = new OpenAPI\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$limit = 56; // int
$interval = new \OpenAPI\Client\Model\\OpenAPI\Client\Model\AccountUsageStatisticsInterval(); // \OpenAPI\Client\Model\AccountUsageStatisticsInterval

try {
    $result = $apiInstance->getUsage($limit, $interval);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getUsage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **limit** | **int**|  | [optional] |
| **interval** | [**\OpenAPI\Client\Model\AccountUsageStatisticsInterval**](../Model/.md)|  | [optional] |

### Return type

**object**

### Authorization

[api_key_query](../../README.md#api_key_query), [api_key_header](../../README.md#api_key_header)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
