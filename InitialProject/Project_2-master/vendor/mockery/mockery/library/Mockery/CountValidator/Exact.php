<?php
<<<<<<< HEAD
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
=======

/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
>>>>>>> main
 */

namespace Mockery\CountValidator;

<<<<<<< HEAD
use Mockery;
=======
use Mockery\Exception\InvalidCountException;

use const PHP_EOL;
>>>>>>> main

class Exact extends CountValidatorAbstract
{
    /**
     * Validate the call count against this validator
     *
     * @param int $n
<<<<<<< HEAD
=======
     *
     * @throws InvalidCountException
>>>>>>> main
     * @return bool
     */
    public function validate($n)
    {
        if ($this->_limit !== $n) {
            $because = $this->_expectation->getExceptionMessage();

<<<<<<< HEAD
            $exception = new Mockery\Exception\InvalidCountException(
=======
            $exception = new InvalidCountException(
>>>>>>> main
                'Method ' . (string) $this->_expectation
                . ' from ' . $this->_expectation->getMock()->mockery_getName()
                . ' should be called' . PHP_EOL
                . ' exactly ' . $this->_limit . ' times but called ' . $n
                . ' times.'
                . ($because ? ' Because ' . $this->_expectation->getExceptionMessage() : '')
            );
            $exception->setMock($this->_expectation->getMock())
                ->setMethodName((string) $this->_expectation)
                ->setExpectedCountComparative('=')
                ->setExpectedCount($this->_limit)
                ->setActualCount($n);
            throw $exception;
        }
    }
}
