<a href="https://tradewatch.io/">
    <img src="https://pub-e8bb70a6cc1844138d6a55fa4a44ba42.r2.dev/logo-purple.png" alt="TradeWatch.io logo" title="TradeWatch.io" align="right" height="60" />
</a>

# TradeWatch.io PHP SDK

[TradeWatch.io](https://tradewatch.io) offers a comprehensive financial data API designed for developers and businesses. The platform provides real-time access to market data, covering a wide range of assets such as currencies, cryptocurrencies, stocks, indices, and commodities. It emphasizes seamless integration, reliability, and scalability, making it ideal for building financial tools and services. Additional features include serverless functions, customizable API domains, and webhook notifications for market events, all aimed at enhancing business efficiency and informed decision-making.

## Table of Contents
- [Quick start](#-quick-start)
- [Requirements](#-requirements)
- [Installation & usage](#-installation--usage)
- [Example](#-example)
- [Available methods](#-available-methods)
- [Available models](#-available-models)
- [Authorization](#-authorization)
- [Feedback and Contributions](#-feedback-and-contributions)
- [Tests](#-tests)
- [License](#-license)
- [Contact and Support](#-contact-and-support)

## 🚀 Quick start

Visit our [Dashboard](https://dash.tradewatch.io/register) and register a free account.

Follow the [Getting started](https://tradewatch.io/docs/platform/getting-started) section in our Developer Portal.

## 📝 Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

## 🔨 Installation & usage

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/tradewatch-io/php-sdk.git"
    }
  ],
  "require": {
    "tradewatch-io/php-sdk": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## 👨‍💻 Example

Please follow the [installation procedure](#installation--usage) and then run the following:

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

## 📖 Available methods

All URIs are relative to *https://api.tradewatch.io*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountApi* | [**getUsage**](docs/Api/AccountApi.md#getusage) | **GET** /account/usage | Usage statistics
*CommoditiesApi* | [**getQuote**](docs/Api/CommoditiesApi.md#getquote) | **GET** /commodities/symbols/{symbol} | Last Quote
*CommoditiesApi* | [**getSymbols**](docs/Api/CommoditiesApi.md#getsymbols) | **GET** /commodities/symbols | Available Symbols
*CommoditiesApi* | [**getTypes**](docs/Api/CommoditiesApi.md#gettypes) | **GET** /commodities/types | Available Types
*CryptoApi* | [**convert**](docs/Api/CryptoApi.md#convert) | **GET** /crypto/convert/{from}/{to} | Conversion
*CryptoApi* | [**getQuote**](docs/Api/CryptoApi.md#getquote) | **GET** /crypto/symbols/{symbol} | Last Quote
*CryptoApi* | [**getSymbols**](docs/Api/CryptoApi.md#getsymbols) | **GET** /crypto/symbols | Available Symbols
*CurrenciesApi* | [**convert**](docs/Api/CurrenciesApi.md#convert) | **GET** /currencies/convert/{from}/{to} | Conversion
*CurrenciesApi* | [**getQuote**](docs/Api/CurrenciesApi.md#getquote) | **GET** /currencies/symbols/{symbol} | Last Quote
*CurrenciesApi* | [**getSymbols**](docs/Api/CurrenciesApi.md#getsymbols) | **GET** /currencies/symbols | Available Symbols
*IndicesApi* | [**getQuote**](docs/Api/IndicesApi.md#getquote) | **GET** /indices/symbols/{symbol} | Last Quote
*IndicesApi* | [**getSymbols**](docs/Api/IndicesApi.md#getsymbols) | **GET** /indices/symbols | Available Symbols
*StocksApi* | [**getCountries**](docs/Api/StocksApi.md#getcountries) | **GET** /stocks/countries | Available Countries
*StocksApi* | [**getQuote**](docs/Api/StocksApi.md#getquote) | **GET** /stocks/symbols/{symbol} | Last Quote
*StocksApi* | [**getSymbols**](docs/Api/StocksApi.md#getsymbols) | **GET** /stocks/symbols | Available Symbols


## 📖 Available models

- [AccountUsageStatisticsInterval](docs/Model/AccountUsageStatisticsInterval.md)
- [ApiUsageDataTransfer](docs/Model/ApiUsageDataTransfer.md)
- [ApiUsageEntry](docs/Model/ApiUsageEntry.md)
- [CommodityType](docs/Model/CommodityType.md)
- [CommodityTypeObj](docs/Model/CommodityTypeObj.md)
- [CommodityTypesList](docs/Model/CommodityTypesList.md)
- [Conversion](docs/Model/Conversion.md)
- [ConversionInfo](docs/Model/ConversionInfo.md)
- [ConversionQuery](docs/Model/ConversionQuery.md)
- [CountriesList](docs/Model/CountriesList.md)
- [Country](docs/Model/Country.md)
- [CountryObj](docs/Model/CountryObj.md)
- [CryptoConversion](docs/Model/CryptoConversion.md)
- [CryptoConversionQuery](docs/Model/CryptoConversionQuery.md)
- [CursorPageTCustomizedSymbolsOutFull](docs/Model/CursorPageTCustomizedSymbolsOutFull.md)
- [ErrorDetails](docs/Model/ErrorDetails.md)
- [ErrorResponseBody](docs/Model/ErrorResponseBody.md)
- [HTTPValidationError](docs/Model/HTTPValidationError.md)
- [LastQuote](docs/Model/LastQuote.md)
- [SymbolsListMode](docs/Model/SymbolsListMode.md)
- [SymbolsOutFull](docs/Model/SymbolsOutFull.md)
- [ValidationError](docs/Model/ValidationError.md)
- [ValidationErrorLocInner](docs/Model/ValidationErrorLocInner.md)

## 🔑 Authorization


Authentication schemes defined for the API:
### api_key_header

- **Type**: API key
- **API key parameter name**: api-key
- **Location**: HTTP header


### api_key_query

- **Type**: API key
- **API key parameter name**: api-key
- **Location**: URL query string



## 🔧 Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## 🤝 Feedback and Contributions

We appreciate your support and look forward to making our product even better with your help!

## ©️ License

This project is licensed under the [MIT License](http://opensource.org/licenses/MIT).


## 🗨️ Contact and Support

For more details about our products, services, or any general information, feel free to reach out to us.

See the list of available [Support Channels](https://tradewatch.io/docs/support/channels).
