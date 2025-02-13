<?php

namespace Maatwebsite\Excel\Events;

use Maatwebsite\Excel\Sheet;

class AfterSheet extends Event
{
    /**
     * @var Sheet
     */
    public $sheet;

    /**
<<<<<<< HEAD
     * @var object
     */
    private $exportable;

    /**
=======
>>>>>>> main
     * @param  Sheet  $sheet
     * @param  object  $exportable
     */
    public function __construct(Sheet $sheet, $exportable)
    {
        $this->sheet      = $sheet;
<<<<<<< HEAD
        $this->exportable = $exportable;
=======
        parent::__construct($exportable);
>>>>>>> main
    }

    /**
     * @return Sheet
     */
    public function getSheet(): Sheet
    {
        return $this->sheet;
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
        return $this->sheet;
    }
}
