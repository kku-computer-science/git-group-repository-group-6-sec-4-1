<?php

namespace PhpOffice\PhpSpreadsheet\Calculation;

/**
 * @deprecated 1.18.0
<<<<<<< HEAD
=======
 *
 * @codeCoverageIgnore
>>>>>>> main
 */
class Web
{
    /**
     * WEBSERVICE.
     *
     * Returns data from a web service on the Internet or Intranet.
     *
     * Excel Function:
     *        Webservice(url)
     *
<<<<<<< HEAD
     * @see Web\Service::webService()
     *      Use the webService() method in the Web\Service class instead
=======
     * @deprecated 1.18.0
     *      Use the webService() method in the Web\Service class instead
     * @see Web\Service::webService()
>>>>>>> main
     *
     * @return string the output resulting from a call to the webservice
     */
    public static function WEBSERVICE(string $url)
    {
        return Web\Service::webService($url);
    }
}
