<?php

namespace Maatwebsite\Excel\Events;

use Maatwebsite\Excel\Reader;

class AfterImport extends Event
{
    /**
     * @var Reader
     */
    public $reader;

    /**
<<<<<<< HEAD
     * @var object
     */
    private $importable;

    /**
=======
>>>>>>> main
     * @param  Reader  $reader
     * @param  object  $importable
     */
    public function __construct(Reader $reader, $importable)
    {
        $this->reader     = $reader;
<<<<<<< HEAD
        $this->importable = $importable;
=======
        parent::__construct($importable);
>>>>>>> main
    }

    /**
     * @return Reader
     */
    public function getReader(): Reader
    {
        return $this->reader;
    }

    /**
<<<<<<< HEAD
     * @return object
     */
    public function getConcernable()
    {
        return $this->importable;
    }

    /**
=======
>>>>>>> main
     * @return mixed
     */
    public function getDelegate()
    {
        return $this->reader;
    }
}
