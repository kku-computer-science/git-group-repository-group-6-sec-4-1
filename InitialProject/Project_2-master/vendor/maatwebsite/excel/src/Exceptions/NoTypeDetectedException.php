<?php

namespace Maatwebsite\Excel\Exceptions;

use Exception;
use Throwable;

class NoTypeDetectedException extends Exception implements LaravelExcelException
{
    /**
     * @param  string  $message
     * @param  int  $code
     * @param  Throwable|null  $previous
     */
    public function __construct(
        $message = 'No ReaderType or WriterType could be detected. Make sure you either pass a valid extension to the filename or pass an explicit type.',
        $code = 0,
<<<<<<< HEAD
        Throwable $previous = null
=======
        ?Throwable $previous = null
>>>>>>> main
    ) {
        parent::__construct($message, $code, $previous);
    }
}
