<?php

namespace Maatwebsite\Excel\Events;

use Maatwebsite\Excel\Writer;

class BeforeWriting extends Event
{
    /**
     * @var Writer
     */
    public $writer;

    /**
     * @var object
     */
    private $exportable;

    /**
     * @param  Writer  $writer
     * @param  object  $exportable
     */
    public function __construct(Writer $writer, $exportable)
    {
        $this->writer     = $writer;
<<<<<<< HEAD
        $this->exportable = $exportable;
=======
        parent::__construct($exportable);
>>>>>>> main
    }

    /**
     * @return Writer
     */
    public function getWriter(): Writer
    {
        return $this->writer;
    }

    /**
<<<<<<< HEAD
     * @return object
     */
    public function getConcernable()
    {
        return $this->exportable;
    }

    /**
=======
>>>>>>> main
     * @return mixed
     */
    public function getDelegate()
    {
        return $this->writer;
    }
}
