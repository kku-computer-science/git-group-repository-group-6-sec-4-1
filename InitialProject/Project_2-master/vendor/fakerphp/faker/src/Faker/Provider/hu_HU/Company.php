<?php

namespace Faker\Provider\hu_HU;

class Company extends \Faker\Provider\Company
{
    protected static $formats = [
        '{{lastName}} {{companySuffix}}',
        '{{lastName}}',
    ];

<<<<<<< HEAD
    protected static $companySuffix = ['Kft', 'és Tsa', 'Kht', 'ZRT', 'NyRT', 'BT'];
=======
    protected static $companySuffix = ['Kft.', 'és Tsa', 'Kht', 'Zrt.', 'Nyrt.', 'Bt.'];
>>>>>>> main
}
