<?php

namespace App\Helpers;

use App\CompanySetting;

class GeneralHelper
{


    /**
     * This method will return date in d-M-Y format like 10-Jul-2017
     *
     * @param mix(String/Integer) $date
     * @param Int $offset No of sec that will add with date
     * @return String Formatted date
     */
    public static function pfgDate($date, $format = 'd-M-Y')
    {
        $formattedDate = '';
        if ($date) {
            if (!is_numeric($date)) {
                $date = strtotime($date);
            }
            $formattedDate = date($format, $date);
        }
        return $formattedDate;
    }

    public static function pfgTime($date, $format = 'h:i:s A')
    {
        $formattedTime = '';
        if ($date) {
            if (!is_numeric($date)) {
                $date = strtotime($date);
            }
            $formattedTime = date($format, $date);
        }
        return $formattedTime;
    }

    /**
     * This method will return date in Y-m-d H:i:s format like 2017-07-10 23:10:20
     *
     * @param mix(String/Integer) $date
     * @return String Formatted date
     */
    public static function pfgMysqlDateTime($date)
    {
        $formattedDate = '';
        if ($date) {
            if (!is_numeric($date)) {
                $date = strtotime($date);
            }

            $formattedDate = date("Y-m-d H:i:s", $date);
        }
        return $formattedDate;
    }

    /**
     * This method will return date in Y-m-d H:i:s format like 2017-07-10 23:10:20
     *
     * @param mix(String/Integer) $date
     * @return String Formatted date
     */
    public static function pfgMysqlDate($date)
    {
        $formattedDate = '';
        if ($date) {
            if (!is_numeric($date)) {
                $date = strtotime($date);
            }

            $formattedDate = date("Y-m-d", $date);
        }
        return $formattedDate;
    }


    public static function twoDecimal($number)
    {
        return number_format((float) $number, 2, '.', '');
    }


    public static function companyDetail()
    {
        return (new CompanySetting())->fetch();
    }

}
