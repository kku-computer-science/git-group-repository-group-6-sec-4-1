<?php

namespace Faker\Guesser;

use Faker\Provider\Base;

class Name
{
    protected $generator;

    public function __construct(\Faker\Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param string   $name
     * @param int|null $size Length of field, if known
     *
     * @return callable|null
     */
    public function guessFormat($name, $size = null)
    {
        $name = Base::toLower($name);
        $generator = $this->generator;

        if (preg_match('/^is[_A-Z]/', $name)) {
            return static function () use ($generator) {
<<<<<<< HEAD
                return $generator->boolean;
=======
                return $generator->boolean();
>>>>>>> main
            };
        }

        if (preg_match('/(_a|A)t$/', $name)) {
            return static function () use ($generator) {
<<<<<<< HEAD
                return $generator->dateTime;
=======
                return $generator->dateTime();
>>>>>>> main
            };
        }

        switch (str_replace('_', '', $name)) {
            case 'firstname':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->firstName;
=======
                    return $generator->firstName();
>>>>>>> main
                };

            case 'lastname':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->lastName;
=======
                    return $generator->lastName();
>>>>>>> main
                };

            case 'username':
            case 'login':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->userName;
=======
                    return $generator->userName();
>>>>>>> main
                };

            case 'email':
            case 'emailaddress':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->email;
=======
                    return $generator->email();
>>>>>>> main
                };

            case 'phonenumber':
            case 'phone':
            case 'telephone':
            case 'telnumber':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->phoneNumber;
=======
                    return $generator->phoneNumber();
>>>>>>> main
                };

            case 'address':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->address;
=======
                    return $generator->address();
>>>>>>> main
                };

            case 'city':
            case 'town':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->city;
=======
                    return $generator->city();
>>>>>>> main
                };

            case 'streetaddress':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->streetAddress;
=======
                    return $generator->streetAddress();
>>>>>>> main
                };

            case 'postcode':
            case 'zipcode':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->postcode;
=======
                    return $generator->postcode();
>>>>>>> main
                };

            case 'state':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->state;
=======
                    return $generator->state();
>>>>>>> main
                };

            case 'county':
                if ($this->generator->locale == 'en_US') {
                    return static function () use ($generator) {
<<<<<<< HEAD
                        return sprintf('%s County', $generator->city);
=======
                        return sprintf('%s County', $generator->city());
>>>>>>> main
                    };
                }

                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->state;
=======
                    return $generator->state();
>>>>>>> main
                };

            case 'country':
                switch ($size) {
                    case 2:
                        return static function () use ($generator) {
<<<<<<< HEAD
                            return $generator->countryCode;
=======
                            return $generator->countryCode();
>>>>>>> main
                        };

                    case 3:
                        return static function () use ($generator) {
<<<<<<< HEAD
                            return $generator->countryISOAlpha3;
=======
                            return $generator->countryISOAlpha3();
>>>>>>> main
                        };

                    case 5:
                    case 6:
                        return static function () use ($generator) {
<<<<<<< HEAD
                            return $generator->locale;
=======
                            return $generator->locale();
>>>>>>> main
                        };

                    default:
                        return static function () use ($generator) {
<<<<<<< HEAD
                            return $generator->country;
=======
                            return $generator->country();
>>>>>>> main
                        };
                }

                break;

            case 'locale':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->locale;
=======
                    return $generator->locale();
>>>>>>> main
                };

            case 'currency':
            case 'currencycode':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->currencyCode;
=======
                    return $generator->currencyCode();
>>>>>>> main
                };

            case 'url':
            case 'website':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->url;
=======
                    return $generator->url();
>>>>>>> main
                };

            case 'company':
            case 'companyname':
            case 'employer':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->company;
=======
                    return $generator->company();
>>>>>>> main
                };

            case 'title':
                if ($size !== null && $size <= 10) {
                    return static function () use ($generator) {
<<<<<<< HEAD
                        return $generator->title;
=======
                        return $generator->title();
>>>>>>> main
                    };
                }

                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->sentence;
=======
                    return $generator->sentence();
>>>>>>> main
                };

            case 'body':
            case 'summary':
            case 'article':
            case 'description':
                return static function () use ($generator) {
<<<<<<< HEAD
                    return $generator->text;
=======
                    return $generator->text();
>>>>>>> main
                };
        }

        return null;
    }
}
