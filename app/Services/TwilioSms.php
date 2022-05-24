<?php

namespace App\Services;

use App\Helpers\Utils;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;

/**
 * A service class to send sms.
 *
 * @author carl
 * @return bool
 */
class TwilioSms
{
    public static $twilioSms;
    public static $countryCodes;

    public static function init()
    {
        self::$twilioSms = new Client(
            config('services.twilio.account_sid'),
            config('services.twilio.auth_token')
        );

        self::$countryCodes = json_decode(file_get_contents(storage_path().'/json/Countries.json'), true);
    }

    public static function send(array $sms)
    {
        self::init();

        try {
            $number = self::validateNumberToInternationalFormat($sms['number'], $sms['country']);

            return self::$twilioSms
                  ->messages
                  ->create($number,
                      [
                        'from' => config('services.twilio.phone_number'),
                        'body' => $sms['content'],
                      ]
                  );
        } catch (RestException $e) {
            return false;
        }

        return false;
    }

    public static function lookUp($number)
    {
        self::init();

        $phone_number = self::$twilioSms
        ->lookups
        ->v1
        ->phoneNumbers($number)
        ->fetch(
            [
              'type' => 'carrier',
            ]
          );

        return $phone_number->carrier;
    }

    public static function validateNumberToInternationalFormat($number, $country_code = 'PH')
    {
        $country_codes = self::$countryCodes;
        $country_code = self::getCountryCodeByName(strtoupper($country_code));
        $default_country_code = '63';
        $number = preg_replace("/\([0-9]+?\)/", '', $number);
        $number = preg_replace('/[^0-9]/', '', $number);
        $number = ltrim($number, '0');
        if (array_key_exists($country_code, $country_codes)) {
            $pfx = $country_codes[$country_code];
        } else {
            $pfx = $default_country_code;
        }
        if (! preg_match('/^'.$pfx.'/', $number)) {
            $number = $pfx.$number;
        }

        return '+'.$number;
    }

    public static function getCountryCodeByName($countryName)
    {
        $countrys = self::$countryCodes;
        $country_code = 'PH';
        foreach ($countrys as $country) {
            if ($country['name'] === $countryName) {
                $country_code = $value['code'];
            }
        }

        return $country_code;
    }
}
