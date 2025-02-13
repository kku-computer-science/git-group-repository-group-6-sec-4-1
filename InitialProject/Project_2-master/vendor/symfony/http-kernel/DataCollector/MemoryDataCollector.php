<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final
 */
class MemoryDataCollector extends DataCollector implements LateDataCollectorInterface
{
    public function __construct()
    {
        $this->reset();
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function collect(Request $request, Response $response, \Throwable $exception = null)
=======
    public function collect(Request $request, Response $response, ?\Throwable $exception = null)
>>>>>>> main
    {
        $this->updateMemoryUsage();
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->data = [
            'memory' => 0,
<<<<<<< HEAD
            'memory_limit' => $this->convertToBytes(ini_get('memory_limit')),
=======
            'memory_limit' => $this->convertToBytes(\ini_get('memory_limit')),
>>>>>>> main
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function lateCollect()
    {
        $this->updateMemoryUsage();
    }

    public function getMemory(): int
    {
        return $this->data['memory'];
    }

    /**
     * @return int|float
     */
    public function getMemoryLimit()
    {
        return $this->data['memory_limit'];
    }

    public function updateMemoryUsage()
    {
        $this->data['memory'] = memory_get_peak_usage(true);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'memory';
    }

    /**
     * @return int|float
     */
    private function convertToBytes(string $memoryLimit)
    {
        if ('-1' === $memoryLimit) {
            return -1;
        }

        $memoryLimit = strtolower($memoryLimit);
        $max = strtolower(ltrim($memoryLimit, '+'));
        if (str_starts_with($max, '0x')) {
            $max = \intval($max, 16);
        } elseif (str_starts_with($max, '0')) {
            $max = \intval($max, 8);
        } else {
            $max = (int) $max;
        }

        switch (substr($memoryLimit, -1)) {
            case 't': $max *= 1024;
<<<<<<< HEAD
            // no break
            case 'g': $max *= 1024;
            // no break
            case 'm': $max *= 1024;
            // no break
=======
                // no break
            case 'g': $max *= 1024;
                // no break
            case 'm': $max *= 1024;
                // no break
>>>>>>> main
            case 'k': $max *= 1024;
        }

        return $max;
    }
}
