<?php

namespace Faker\Calculator;

class Iban
{
    /**
     * Generates IBAN Checksum
     *
<<<<<<< HEAD
     * @param string $iban
     *
     * @return string Checksum (numeric string)
     */
    public static function checksum($iban)
=======
     * @return string Checksum (numeric string)
     */
    public static function checksum(string $iban)
>>>>>>> main
    {
        // Move first four digits to end and set checksum to '00'
        $checkString = substr($iban, 4) . substr($iban, 0, 2) . '00';

        // Replace all letters with their number equivalents
<<<<<<< HEAD
        $checkString = preg_replace_callback('/[A-Z]/', ['self', 'alphaToNumberCallback'], $checkString);
=======
        $checkString = preg_replace_callback(
            '/[A-Z]/',
            static function (array $matches): string {
                return (string) self::alphaToNumber($matches[0]);
            },
            $checkString,
        );
>>>>>>> main

        // Perform mod 97 and subtract from 98
        $checksum = 98 - self::mod97($checkString);

        return str_pad($checksum, 2, '0', STR_PAD_LEFT);
    }

    /**
<<<<<<< HEAD
     * @param string $match
     *
     * @return int
     */
    private static function alphaToNumberCallback($match)
    {
        return self::alphaToNumber($match[0]);
    }

    /**
     * Converts letter to number
     *
     * @param string $char
     *
     * @return int
     */
    public static function alphaToNumber($char)
=======
     * Converts letter to number
     *
     * @return int
     */
    public static function alphaToNumber(string $char)
>>>>>>> main
    {
        return ord($char) - 55;
    }

    /**
     * Calculates mod97 on a numeric string
     *
     * @param string $number Numeric string
     *
     * @return int
     */
<<<<<<< HEAD
    public static function mod97($number)
=======
    public static function mod97(string $number)
>>>>>>> main
    {
        $checksum = (int) $number[0];

        for ($i = 1, $size = strlen($number); $i < $size; ++$i) {
            $checksum = (10 * $checksum + (int) $number[$i]) % 97;
        }

        return $checksum;
    }

    /**
     * Checks whether an IBAN has a valid checksum
     *
<<<<<<< HEAD
     * @param string $iban
     *
     * @return bool
     */
    public static function isValid($iban)
=======
     * @return bool
     */
    public static function isValid(string $iban)
>>>>>>> main
    {
        return self::checksum($iban) === substr($iban, 2, 2);
    }
}
