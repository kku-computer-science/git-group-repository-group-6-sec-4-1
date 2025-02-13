<?php

namespace PhpOffice\PhpSpreadsheet\Shared;

use DateTimeZone;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class TimeZone
{
    /**
     * Default Timezone used for date/time conversions.
     *
     * @var string
     */
    protected static $timezone = 'UTC';

    /**
     * Validate a Timezone name.
     *
     * @param string $timezoneName Time zone (e.g. 'Europe/London')
     *
     * @return bool Success or failure
     */
<<<<<<< HEAD
    private static function validateTimeZone($timezoneName)
    {
        return in_array($timezoneName, DateTimeZone::listIdentifiers(DateTimeZone::ALL_WITH_BC));
=======
    private static function validateTimeZone(string $timezoneName): bool
    {
        return in_array($timezoneName, DateTimeZone::listIdentifiers(DateTimeZone::ALL_WITH_BC), true);
>>>>>>> main
    }

    /**
     * Set the Default Timezone used for date/time conversions.
     *
     * @param string $timezoneName Time zone (e.g. 'Europe/London')
     *
     * @return bool Success or failure
     */
<<<<<<< HEAD
    public static function setTimeZone($timezoneName)
    {
        if (self::validateTimezone($timezoneName)) {
=======
    public static function setTimeZone(string $timezoneName): bool
    {
        if (self::validateTimeZone($timezoneName)) {
>>>>>>> main
            self::$timezone = $timezoneName;

            return true;
        }

        return false;
    }

    /**
     * Return the Default Timezone used for date/time conversions.
     *
     * @return string Timezone (e.g. 'Europe/London')
     */
<<<<<<< HEAD
    public static function getTimeZone()
=======
    public static function getTimeZone(): string
>>>>>>> main
    {
        return self::$timezone;
    }

    /**
     *    Return the Timezone offset used for date/time conversions to/from UST
     * This requires both the timezone and the calculated date/time to allow for local DST.
     *
     * @param ?string $timezoneName The timezone for finding the adjustment to UST
     * @param float|int $timestamp PHP date/time value
     *
     * @return int Number of seconds for timezone adjustment
     */
<<<<<<< HEAD
    public static function getTimeZoneAdjustment($timezoneName, $timestamp)
    {
        $timezoneName = $timezoneName ?? self::$timezone;
        $dtobj = Date::dateTimeFromTimestamp("$timestamp");
        if (!self::validateTimezone($timezoneName)) {
=======
    public static function getTimeZoneAdjustment(?string $timezoneName, $timestamp): int
    {
        $timezoneName = $timezoneName ?? self::$timezone;
        $dtobj = Date::dateTimeFromTimestamp("$timestamp");
        if (!self::validateTimeZone($timezoneName)) {
>>>>>>> main
            throw new PhpSpreadsheetException("Invalid timezone $timezoneName");
        }
        $dtobj->setTimeZone(new DateTimeZone($timezoneName));

        return $dtobj->getOffset();
    }
}
