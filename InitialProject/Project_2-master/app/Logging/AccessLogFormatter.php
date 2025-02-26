<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class AccessLogFormatter
{
    public function __invoke($logger)
    {
        $formatter = new LineFormatter(
            "[%datetime%] %extra.ip:%extra.port [%extra.status]: %extra.method %extra.url\n",
            'D M d H:i:s Y', // Date format: Thu Feb 27 01:15:50 2025
            true
        );
        $logger->setFormatter($formatter);
    }
}