<?php
<<<<<<< HEAD
=======

>>>>>>> main
declare(strict_types=1);

namespace ZipStream\Exception;

use ZipStream\Exception;

/**
 * This Exception gets invoked if a file wasn't found
 */
class FileNotFoundException extends Exception
{
    /**
<<<<<<< HEAD
     * Constructor of the Exception
     *
     * @param String $path - The path which wasn't found
     */
    public function __construct(string $path)
    {
=======
     * @internal
     */
    public function __construct(
        public readonly string $path
    ) {
>>>>>>> main
        parent::__construct("The file with the path $path wasn't found.");
    }
}
