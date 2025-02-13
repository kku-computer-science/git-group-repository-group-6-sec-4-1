<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> main
namespace GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
<<<<<<< HEAD
     *
     * @return bool
     */
    public static function pending(PromiseInterface $promise)
=======
     */
    public static function pending(PromiseInterface $promise): bool
>>>>>>> main
    {
        return $promise->getState() === PromiseInterface::PENDING;
    }

    /**
     * Returns true if a promise is fulfilled or rejected.
<<<<<<< HEAD
     *
     * @return bool
     */
    public static function settled(PromiseInterface $promise)
=======
     */
    public static function settled(PromiseInterface $promise): bool
>>>>>>> main
    {
        return $promise->getState() !== PromiseInterface::PENDING;
    }

    /**
     * Returns true if a promise is fulfilled.
<<<<<<< HEAD
     *
     * @return bool
     */
    public static function fulfilled(PromiseInterface $promise)
=======
     */
    public static function fulfilled(PromiseInterface $promise): bool
>>>>>>> main
    {
        return $promise->getState() === PromiseInterface::FULFILLED;
    }

    /**
     * Returns true if a promise is rejected.
<<<<<<< HEAD
     *
     * @return bool
     */
    public static function rejected(PromiseInterface $promise)
=======
     */
    public static function rejected(PromiseInterface $promise): bool
>>>>>>> main
    {
        return $promise->getState() === PromiseInterface::REJECTED;
    }
}
