<?php


namespace RServices\Helpers;


class TransactionParser
{

    const RE = 're';
    const RENR = 'renr';

    /**
     * @example ReNr 10002, KdNr K1013
     * @example RE10002
     *
     * @param string $reference
     * @return array|bool|mixed
     */
    public static function getInvoiceId(string $reference)
    {
        try {
            $reference = strtolower($reference);
            if (str_starts_with($reference, self::RE) && !str_starts_with($reference, self::RENR))
                return explode(self::RE, $reference)[1];
            if (str_starts_with($reference, self::RENR)) {
                $count = count(explode(' ', $reference)) - 1;
                if ($count == 3 && strpos($reference, 'renr') !== false && strpos($reference, 'kdnr') !== false) {
                    $reference = str_replace(' ', ':', str_replace('| ', '|', str_replace(',', '|', $reference)));

                    $array = [];
                    foreach (explode('|', $reference) as $l) {
                        $arr = explode(':', $l);
                        $array[strtolower($arr[0])] = $arr[1];
                    }
                    if (array_key_exists('renr', $array))
                        return $array['renr'];
                    return $array;
                }
            }
            return false;
        } catch (\Exception $exception) {
            return false;
        }
    }

}
