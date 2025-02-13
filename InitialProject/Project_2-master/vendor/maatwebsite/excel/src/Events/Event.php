<?php

namespace Maatwebsite\Excel\Events;

<<<<<<< HEAD
abstract class Event
{
    /**
     * @return object
     */
    abstract public function getConcernable();
=======
/**
 * @internal
 */
abstract class Event
{
    /**
     * @var object
     */
    protected $concernable;

    /**
     * @param  object  $concernable
     */
    public function __construct($concernable)
    {
        $this->concernable = $concernable;
    }

    /**
     * @return object
     */
    public function getConcernable()
    {
        return $this->concernable;
    }
>>>>>>> main

    /**
     * @return mixed
     */
    abstract public function getDelegate();

    /**
     * @param  string  $concern
     * @return bool
     */
    public function appliesToConcern(string $concern): bool
    {
        return $this->getConcernable() instanceof $concern;
    }
}
