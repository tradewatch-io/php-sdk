<?php

namespace Tradewatch\Types;

use Tradewatch\Core\Json\JsonSerializableType;
use Tradewatch\Core\Json\JsonProperty;
use DateTime;
use Tradewatch\Core\Types\Date;
use Tradewatch\Core\Types\ArrayType;

class MarketResponse extends JsonSerializableType
{
    /**
     * @var string $mic Market Identifier Code (ISO 10383)
     */
    #[JsonProperty('mic')]
    public string $mic;

    /**
     * @var string $exchange Full name of the exchange
     */
    #[JsonProperty('exchange')]
    public string $exchange;

    /**
     * @var ?string $acronym Exchange acronym
     */
    #[JsonProperty('acronym')]
    public ?string $acronym;

    /**
     * @var string $lei Legal Entity Identifier
     */
    #[JsonProperty('lei')]
    public string $lei;

    /**
     * @var string $url Exchange website URL
     */
    #[JsonProperty('url')]
    public string $url;

    /**
     * @var string $city City where the exchange is located
     */
    #[JsonProperty('city')]
    public string $city;

    /**
     * @var string $country Country where the exchange is located
     */
    #[JsonProperty('country')]
    public string $country;

    /**
     * @var string $countryCode ISO 3166-1 alpha-2 country code
     */
    #[JsonProperty('country_code')]
    public string $countryCode;

    /**
     * @var string $flag Country flag emoji
     */
    #[JsonProperty('flag')]
    public string $flag;

    /**
     * @var string $currencyName Name of the primary currency used
     */
    #[JsonProperty('currency_name')]
    public string $currencyName;

    /**
     * @var string $currencyCode ISO 4217 currency code
     */
    #[JsonProperty('currency_code')]
    public string $currencyCode;

    /**
     * @var string $currencySymbol Symbol of the currency
     */
    #[JsonProperty('currency_symbol')]
    public string $currencySymbol;

    /**
     * @var string $region Geographical region
     */
    #[JsonProperty('region')]
    public string $region;

    /**
     * @var string $timezone Timezone identifier (IANA database)
     */
    #[JsonProperty('timezone')]
    public string $timezone;

    /**
     * @var string $timezoneAbbr Timezone abbreviation
     */
    #[JsonProperty('timezone_abbr')]
    public string $timezoneAbbr;

    /**
     * @var string $utcOffset UTC offset in hours
     */
    #[JsonProperty('utc_offset')]
    public string $utcOffset;

    /**
     * @var bool $dst Whether Daylight Saving Time is currently observed
     */
    #[JsonProperty('dst')]
    public bool $dst;

    /**
     * @var ?DateTime $previousDstTransition Date of the previous DST transition
     */
    #[JsonProperty('previous_dst_transition'), Date(Date::TYPE_DATE)]
    public ?DateTime $previousDstTransition;

    /**
     * @var ?DateTime $nextDstTransition Date of the next DST transition
     */
    #[JsonProperty('next_dst_transition'), Date(Date::TYPE_DATE)]
    public ?DateTime $nextDstTransition;

    /**
     * @var array<value-of<Weekday>> $workingDays List of working days
     */
    #[JsonProperty('working_days'), ArrayType(['string'])]
    public array $workingDays;

    /**
     * @var string $openTime Regular trading session opening time
     */
    #[JsonProperty('open_time')]
    public string $openTime;

    /**
     * @var string $closeTime Regular trading session closing time
     */
    #[JsonProperty('close_time')]
    public string $closeTime;

    /**
     * @var ?string $earlyCloseTime Trading session closing time on early close days
     */
    #[JsonProperty('early_close_time')]
    public ?string $earlyCloseTime;

    /**
     * @param array{
     *   mic: string,
     *   exchange: string,
     *   lei: string,
     *   url: string,
     *   city: string,
     *   country: string,
     *   countryCode: string,
     *   flag: string,
     *   currencyName: string,
     *   currencyCode: string,
     *   currencySymbol: string,
     *   region: string,
     *   timezone: string,
     *   timezoneAbbr: string,
     *   utcOffset: string,
     *   dst: bool,
     *   workingDays: array<value-of<Weekday>>,
     *   openTime: string,
     *   closeTime: string,
     *   acronym?: ?string,
     *   previousDstTransition?: ?DateTime,
     *   nextDstTransition?: ?DateTime,
     *   earlyCloseTime?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mic = $values['mic'];
        $this->exchange = $values['exchange'];
        $this->acronym = $values['acronym'] ?? null;
        $this->lei = $values['lei'];
        $this->url = $values['url'];
        $this->city = $values['city'];
        $this->country = $values['country'];
        $this->countryCode = $values['countryCode'];
        $this->flag = $values['flag'];
        $this->currencyName = $values['currencyName'];
        $this->currencyCode = $values['currencyCode'];
        $this->currencySymbol = $values['currencySymbol'];
        $this->region = $values['region'];
        $this->timezone = $values['timezone'];
        $this->timezoneAbbr = $values['timezoneAbbr'];
        $this->utcOffset = $values['utcOffset'];
        $this->dst = $values['dst'];
        $this->previousDstTransition = $values['previousDstTransition'] ?? null;
        $this->nextDstTransition = $values['nextDstTransition'] ?? null;
        $this->workingDays = $values['workingDays'];
        $this->openTime = $values['openTime'];
        $this->closeTime = $values['closeTime'];
        $this->earlyCloseTime = $values['earlyCloseTime'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
