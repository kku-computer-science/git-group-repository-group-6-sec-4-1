<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2022 Justin Hileman
=======
 * (c) 2012-2023 Justin Hileman
>>>>>>> main
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy;

/**
 * Environment variables implementation via $_SERVER superglobal.
 */
class SuperglobalsEnv implements EnvInterface
{
    /**
     * Get an environment variable by name.
     *
     * @return string|null
     */
    public function get(string $key)
    {
        if (isset($_SERVER[$key]) && $_SERVER[$key]) {
            return $_SERVER[$key];
        }

        return null;
    }
}
