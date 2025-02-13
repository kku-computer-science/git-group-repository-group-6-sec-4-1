<?php

<<<<<<< HEAD
namespace Mockery\Exception;

class BadMethodCallException extends \BadMethodCallException
{
=======
/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
 */

namespace Mockery\Exception;

class BadMethodCallException extends \BadMethodCallException implements MockeryExceptionInterface
{
    /**
     * @var bool
     */
>>>>>>> main
    private $dismissed = false;

    public function dismiss()
    {
        $this->dismissed = true;
<<<<<<< HEAD

        // we sometimes stack them
        if ($this->getPrevious() && $this->getPrevious() instanceof BadMethodCallException) {
            $this->getPrevious()->dismiss();
        }
    }

=======
        // we sometimes stack them
        $previous = $this->getPrevious();
        if (! $previous instanceof self) {
            return;
        }

        $previous->dismiss();
    }

    /**
     * @return bool
     */
>>>>>>> main
    public function dismissed()
    {
        return $this->dismissed;
    }
}
