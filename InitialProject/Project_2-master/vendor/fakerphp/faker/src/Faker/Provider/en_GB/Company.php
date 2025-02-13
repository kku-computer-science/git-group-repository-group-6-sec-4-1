<?php

namespace Faker\Provider\en_GB;

class Company extends \Faker\Provider\Company
{
    public const VAT_PREFIX = 'GB';
    public const VAT_TYPE_DEFAULT = 'vat';
    public const VAT_TYPE_BRANCH = 'branch';
    public const VAT_TYPE_GOVERNMENT = 'gov';
    public const VAT_TYPE_HEALTH_AUTHORITY = 'health';

    /**
     * UK VAT number
     *
     * This method produces numbers that are _reasonably_ representative
     * of those issued by government
     *
     * @see https://en.wikipedia.org/wiki/VAT_identification_number#VAT_numbers_by_country
     */
<<<<<<< HEAD
    public static function vat(string $type = null): string
    {
        switch ($type) {

=======
    public static function vat(?string $type = null): string
    {
        switch ($type) {
>>>>>>> main
            case static::VAT_TYPE_BRANCH:
                return static::generateBranchTraderVatNumber();

            case static::VAT_TYPE_GOVERNMENT:
                return static::generateGovernmentVatNumber();

            case static::VAT_TYPE_HEALTH_AUTHORITY:
                return static::generateHealthAuthorityVatNumber();

            default:
                return static::generateStandardVatNumber();
<<<<<<< HEAD

=======
>>>>>>> main
        }
    }

    /**
     * Standard
     * 9 digits (block of 3, block of 4, block of 2)
     *
     * This uses the format introduced November 2009 onward where the first
     * block starts from 100 and the final two digits are generated via a the
     * modulus 9755 algorithm
     */
    private static function generateStandardVatNumber(): string
    {
        $firstBlock = static::numberBetween(100, 999);
        $secondBlock = static::randomNumber(4, true);

        return sprintf(
            '%s%d %d %d',
            static::VAT_PREFIX,
            $firstBlock,
            $secondBlock,
<<<<<<< HEAD
            static::calculateModulus97($firstBlock . $secondBlock)
=======
            static::calculateModulus97($firstBlock . $secondBlock),
>>>>>>> main
        );
    }

    /**
     * Health authorities
     * the letters HA then 3 digits from 500 to 999 (e.g. GBHA599)
     */
    private static function generateHealthAuthorityVatNumber(): string
    {
        return sprintf(
            '%sHA%d',
            static::VAT_PREFIX,
<<<<<<< HEAD
            static::numberBetween(500, 999)
=======
            static::numberBetween(500, 999),
>>>>>>> main
        );
    }

    /**
     * Branch traders
     * 12 digits (as for 9 digits, followed by a block of 3 digits)
     */
    private static function generateBranchTraderVatNumber(): string
    {
        return sprintf(
            '%s %d',
            static::generateStandardVatNumber(),
<<<<<<< HEAD
            static::randomNumber(3, true)
=======
            static::randomNumber(3, true),
>>>>>>> main
        );
    }

    /**
     * Government departments
     * the letters GD then 3 digits from 000 to 499 (e.g. GBGD001)
     */
    private static function generateGovernmentVatNumber(): string
    {
        return sprintf(
            '%sGD%s',
            static::VAT_PREFIX,
<<<<<<< HEAD
            str_pad((string) static::numberBetween(0, 499), 3, '0', STR_PAD_LEFT)
=======
            str_pad((string) static::numberBetween(0, 499), 3, '0', STR_PAD_LEFT),
>>>>>>> main
        );
    }

    /**
     * Apply a Modulus97 algorithm to an input
     *
     * @see https://library.croneri.co.uk/cch_uk/bvr/43-600
     */
    public static function calculateModulus97(string $input, bool $use9755 = true): string
    {
        $digits = str_split($input);

        if (count($digits) !== 7) {
            throw new \InvalidArgumentException();
        }
        $multiplier = 8;
        $sum = 0;

        foreach ($digits as $digit) {
            $sum += (int) $digit * $multiplier;
            --$multiplier ;
        }

        if ($use9755) {
            $sum = $sum + 55;
        }

        while ($sum > 0) {
            $sum -= 97;
        }
        $sum = $sum * -1;

        return str_pad((string) $sum, 2, '0', STR_PAD_LEFT);
    }
}
