<?php

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
 * Authors:
 * - Philippe Vaucher
 * - Tsutomu Kuroda
 * - tjku
 * - Max Melentiev
 * - Zolzaya Erdenebaatar
 * - Tom Hughes
 * - Akira Matsuda
 * - Christopher Dell
 * - Michael Kessler
 * - Enrique Vidal
 * - Simone Carletti
 * - Aaron Patterson
 * - Nicolás Hock Isaza
 * - Ochirkhuyag
 * - Batmandakh
<<<<<<< HEAD
=======
 * - lucifer-crybaby
>>>>>>> main
 */
return [
    'year' => ':count жил',
    'y' => ':count жил',
    'month' => ':count сар',
    'm' => ':count сар',
    'week' => ':count долоо хоног',
    'w' => ':count долоо хоног',
    'day' => ':count өдөр',
    'd' => ':count өдөр',
    'hour' => ':count цаг',
    'h' => ':countц',
    'minute' => ':count минут',
    'min' => ':countм',
    'second' => ':count секунд',
    's' => ':countс',

<<<<<<< HEAD
    'ago' => ':timeн өмнө',
    'year_ago' => ':count жилий',
    'month_ago' => ':count сары',
    'day_ago' => ':count хоногий',
    'hour_ago' => ':count цагий',
    'minute_ago' => ':count минуты',
    'second_ago' => ':count секунды',

    'from_now' => 'одоогоос :time',
    'year_from_now' => ':count жилийн дараа',
    'month_from_now' => ':count сарын дараа',
    'day_from_now' => ':count хоногийн дараа',
=======
    'ago_mode' => 'last',
    'ago' => ':time өмнө',
    'year_ago' => ':count жилийн',
    'y_ago' => ':count жилийн',
    'month_ago' => ':count сарын',
    'm_ago' => ':count сарын',
    'day_ago' => ':count хоногийн',
    'd_ago' => ':count хоногийн',
    'week_ago' => ':count долоо хоногийн',
    'w_ago' => ':count долоо хоногийн',
    'hour_ago' => ':count цагийн',
    'minute_ago' => ':count минутын',
    'second_ago' => ':count секундын',

    'from_now_mode' => 'last',
    'from_now' => 'одоогоос :time',
    'year_from_now' => ':count жилийн дараа',
    'y_from_now' => ':count жилийн дараа',
    'month_from_now' => ':count сарын дараа',
    'm_from_now' => ':count сарын дараа',
    'day_from_now' => ':count хоногийн дараа',
    'd_from_now' => ':count хоногийн дараа',
>>>>>>> main
    'hour_from_now' => ':count цагийн дараа',
    'minute_from_now' => ':count минутын дараа',
    'second_from_now' => ':count секундын дараа',

<<<<<<< HEAD
    // Does it required to make translation for before, after as follows? hmm, I think we've made it with ago and from now keywords already. Anyway, I've included it just in case of undesired action...
    'after' => ':timeн дараа',
    'year_after' => ':count жилий',
    'month_after' => ':count сары',
    'day_after' => ':count хоногий',
    'hour_after' => ':count цагий',
    'minute_after' => ':count минуты',
    'second_after' => ':count секунды',

    'before' => ':timeн өмнө',
    'year_before' => ':count жилий',
    'month_before' => ':count сары',
    'day_before' => ':count хоногий',
    'hour_before' => ':count цагий',
    'minute_before' => ':count минуты',
    'second_before' => ':count секунды',
=======
    'after_mode' => 'last',
    'after' => ':time дараа',
    'year_after' => ':count жилийн',
    'y_after' => ':count жилийн',
    'month_after' => ':count сарын',
    'm_after' => ':count сарын',
    'day_after' => ':count хоногийн',
    'd_after' => ':count хоногийн',
    'hour_after' => ':count цагийн',
    'minute_after' => ':count минутын',
    'second_after' => ':count секундын',

    'before_mode' => 'last',
    'before' => ':time өмнө',
    'year_before' => ':count жилийн',
    'y_before' => ':count жилийн',
    'month_before' => ':count сарын',
    'm_before' => ':count сарын',
    'day_before' => ':count хоногийн',
    'd_before' => ':count хоногийн',
    'hour_before' => ':count цагийн',
    'minute_before' => ':count минутын',
    'second_before' => ':count секундын',
>>>>>>> main

    'list' => ', ',
    'diff_now' => 'одоо',
    'diff_yesterday' => 'өчигдөр',
    'diff_tomorrow' => 'маргааш',
    'formats' => [
        'LT' => 'HH:mm',
        'LTS' => 'HH:mm:ss',
        'L' => 'YYYY-MM-DD',
        'LL' => 'YYYY MMMM DD',
        'LLL' => 'YY-MM-DD, HH:mm',
        'LLLL' => 'YYYY MMMM DD, HH:mm',
    ],
    'weekdays' => ['Ням', 'Даваа', 'Мягмар', 'Лхагва', 'Пүрэв', 'Баасан', 'Бямба'],
    'weekdays_short' => ['Ня', 'Да', 'Мя', 'Лх', 'Пү', 'Ба', 'Бя'],
    'weekdays_min' => ['Ня', 'Да', 'Мя', 'Лх', 'Пү', 'Ба', 'Бя'],
    'months' => ['1 сар', '2 сар', '3 сар', '4 сар', '5 сар', '6 сар', '7 сар', '8 сар', '9 сар', '10 сар', '11 сар', '12 сар'],
    'months_short' => ['1 сар', '2 сар', '3 сар', '4 сар', '5 сар', '6 сар', '7 сар', '8 сар', '9 сар', '10 сар', '11 сар', '12 сар'],
    'meridiem' => ['өглөө', 'орой'],
    'first_day_of_week' => 1,
];
