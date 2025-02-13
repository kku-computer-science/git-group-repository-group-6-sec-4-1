<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> main
namespace Doctrine\Instantiator;

use Doctrine\Instantiator\Exception\ExceptionInterface;

/**
 * Instantiator provides utility methods to build objects without invoking their constructors
 */
interface InstantiatorInterface
{
    /**
<<<<<<< HEAD
     * @param string $className
     * @phpstan-param class-string<T> $className
     *
     * @return object
=======
     * @phpstan-param class-string<T> $className
     *
>>>>>>> main
     * @phpstan-return T
     *
     * @throws ExceptionInterface
     *
     * @template T of object
     */
<<<<<<< HEAD
    public function instantiate($className);
=======
    public function instantiate(string $className): object;
>>>>>>> main
}
