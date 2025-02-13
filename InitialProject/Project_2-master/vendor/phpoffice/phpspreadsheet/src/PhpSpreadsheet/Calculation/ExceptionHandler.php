<?php

namespace PhpOffice\PhpSpreadsheet\Calculation;

class ExceptionHandler
{
    /**
     * Register errorhandler.
     */
    public function __construct()
    {
<<<<<<< HEAD
        set_error_handler([Exception::class, 'errorHandlerCallback'], E_ALL);
=======
        /** @var callable */
        $callable = [Exception::class, 'errorHandlerCallback'];
        set_error_handler($callable, E_ALL);
>>>>>>> main
    }

    /**
     * Unregister errorhandler.
     */
    public function __destruct()
    {
        restore_error_handler();
    }
}
